<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Medicine;
use App\Models\Supply;
use App\Models\Equipment;
use App\Models\Document;  
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        // Check for expiring medicines first
        $this->checkExpiringMedicines();

        // Get total patient count
        $totalPatients = Patient::count();
        
        // Get total medicines count (only for boxes that are not returned)
        $totalMedicines = Medicine::whereHas('box', function($query) {
            $query->where('isReturned', 0);
        })->count();
        
        // You can also get counts by patient type
        $patientCounts = [
            'students' => Patient::where('patientType', 'Student')->count(),
            'faculty' => Patient::where('patientType', 'Faculty')->count(),
            'dependents' => Patient::where('patientType', 'Dependent')->count(),
            'admin' => Patient::where('patientType', 'Admin')->count(),
            'visitors' => Patient::where('patientType', 'Visitor')->count(),
        ];
        
        // Get monthly patient counts for current year
        $monthlyPatients = Patient::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->whereYear('created_at', Carbon::now()->year)
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->pluck('count', 'month')
        ->toArray();

        // Fill in missing months with zero
        $monthlyPatientCounts = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthlyPatientCounts[] = $monthlyPatients[$month] ?? 0;
        }

        // Get returned and not returned medicine counts
        $medicineStatus = [
            'returned' => Medicine::whereHas('box', function($query) {
                $query->where('isReturned', 1);
            })->count(),
            'active' => Medicine::whereHas('box', function($query) {
                $query->where('isReturned', 0);
            })->count()
        ];

        // Get top consumed medicines
        $topMedicines = Medicine::select('medicine_name', 'consumed_quantity', 'unit')
            ->orderByDesc('consumed_quantity')
            ->limit(10)
            ->get();

        // If we have less than 10 medicines, pad the arrays with empty values
        $medicineNames = array_pad($topMedicines->pluck('medicine_name')->toArray(), 10, 'No Medicine');
        $medicineQuantities = array_pad($topMedicines->pluck('consumed_quantity')->toArray(), 10, 0);
        $medicineUnits = array_pad($topMedicines->pluck('unit')->toArray(), 10, '');

        // Get supplies quantities
        $suppliesStatus = [
            'initial' => Supply::sum('initial_quantity'),
            'consumed' => Supply::sum('consumed_quantity')
        ];

        // Get equipment status counts
        $equipmentStatus = [
            'serviceable' => Equipment::where('serviceable', 1)->sum('quantity'),
            'for_repair' => Equipment::where('for_repair', 1)->sum('quantity'),
            'for_condemn' => Equipment::where('for_condemn', 1)->sum('quantity'),
            'need_replacement' => Equipment::where('need_replacement', 1)->sum('quantity')
        ];

        // Get total documents count (excluding soft deleted)
        $totalDocuments = Document::count();  // This automatically excludes soft deleted records

        $totalReports = Report::count();

        return view('dashboard.dashboard_index', compact(
            'totalPatients', 
            'patientCounts', 
            'totalMedicines',
            'monthlyPatientCounts',
            'medicineStatus',
            'medicineNames',
            'medicineQuantities',
            'medicineUnits',
            'suppliesStatus',
            'equipmentStatus',
            'totalDocuments',
            'totalReports'
        ));
    }

   /**
 * Check for medicines that are about to expire and create notifications
 */
private function checkExpiringMedicines()
{
    try {
        // Get current date without time component
        $today = Carbon::today('Asia/Manila');
        
        // Get all user IDs for notifications
        $userIds = User::pluck('id')->toArray();
        
        Log::info('Starting medicine expiry check', [
            'today' => $today->format('Y-m-d'),
            'users' => count($userIds)
        ]);

        // Get active medicines with expiration dates
        // Note: Using medicines table's expiration_date field directly
        $medicines = Medicine::whereNotNull('expiration_date')
            ->whereDate('expiration_date', '>=', $today)
            ->whereHas('box', function($query) {
                $query->where('isReturned', 0);
            })
            ->get();

        Log::info('Found medicines to check', ['count' => $medicines->count()]);

        foreach ($medicines as $medicine) {
            // Parse expiration date properly
            $expiryDate = Carbon::parse($medicine->expiration_date)->startOfDay();
            
            // Calculate days until expiration
            $daysRemaining = $today->diffInDays($expiryDate);
            
            Log::info('Checking medicine', [
                'id' => $medicine->id,
                'name' => $medicine->medicine_name,
                'expiry_date' => $expiryDate->format('Y-m-d'),
                'days_remaining' => $daysRemaining,
                'notification_status' => [
                    'notified_monthly' => (bool)$medicine->notified_monthly,
                    'notified_weekly' => (bool)$medicine->notified_weekly, 
                    'notified_today' => (bool)$medicine->notified_today
                ]
            ]);

            // Monthly notification (8-30 days)
            if ($daysRemaining <= 30 && $daysRemaining > 7 && !$medicine->notified_monthly) {
                Log::info('Creating monthly notification', [
                    'medicine' => $medicine->medicine_name,
                    'days' => $daysRemaining
                ]);
                
                try {
                    $notification = new Notification();
                    $notification->title = 'Medicine Expiring in a Month';
                    $notification->message = "{$medicine->medicine_name} will expire in {$daysRemaining} " . 
                                        ($daysRemaining == 1 ? 'day' : 'days') . " (on " . 
                                        $expiryDate->format('M d, Y') . ")";
                    $notification->type = 'warning';
                    $notification->users_id = json_encode($userIds);
                    $notification->viewed_by = json_encode([]);
                    $notification->reference_id = $medicine->id;
                    $notification->save();
                    
                    $medicine->notified_monthly = true;
                    $medicine->save();
                    
                    Log::info('Successfully created monthly notification', [
                        'notification_id' => $notification->id
                    ]);
                } catch (\Exception $e) {
                    Log::error('Error creating monthly notification', [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                }
            }
            
            // Weekly notification (2-7 days)
            if ($daysRemaining <= 7 && $daysRemaining >= 1 && !$medicine->notified_weekly) {
                Log::info('Creating weekly notification', [
                    'medicine' => $medicine->medicine_name,
                    'days' => $daysRemaining
                ]);
                
                try {
                    $notification = new Notification();
                    $notification->title = 'Medicine Expiring This Week';
                    $notification->message = "{$medicine->medicine_name} will expire in {$daysRemaining} " . 
                                        ($daysRemaining == 1 ? 'day' : 'days') . " (on " . 
                                        $expiryDate->format('M d, Y') . ")";
                    $notification->type = 'danger';
                    $notification->users_id = json_encode($userIds);
                    $notification->viewed_by = json_encode([]);
                    $notification->reference_id = $medicine->id;
                    $notification->save();
                    
                    $medicine->notified_weekly = true;
                    $medicine->save();
                    
                    Log::info('Successfully created weekly notification', [
                        'notification_id' => $notification->id
                    ]);
                } catch (\Exception $e) {
                    Log::error('Error creating weekly notification', [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                }
            }
            
            // Daily notification (0 day)
            if ($daysRemaining == 0 && !$medicine->notified_today) {
                Log::info('Creating daily notification', [
                    'medicine' => $medicine->medicine_name,
                    'days' => $daysRemaining
                ]);
                
                $message = $daysRemaining == 0 
                    ? "{$medicine->medicine_name} will expire today (" . $expiryDate->format('M d, Y') . ")"
                    : "{$medicine->medicine_name} will expire tomorrow (" . $expiryDate->format('M d, Y') . ")";
                    
                try {
                    $notification = new Notification();
                    $notification->title = 'Medicine Expiring Today';
                    $notification->message = $message;
                    $notification->type = 'danger';
                    $notification->users_id = json_encode($userIds);
                    $notification->viewed_by = json_encode([]);
                    $notification->reference_id = $medicine->id;
                    $notification->save();
                    
                    $medicine->notified_today = true;
                    $medicine->save();
                    
                    Log::info('Successfully created daily notification', [
                        'notification_id' => $notification->id
                    ]);
                } catch (\Exception $e) {
                    Log::error('Error creating daily notification', [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                }
            }
        }
        
        Log::info('Completed medicine expiry check');
        
    } catch (\Exception $e) {
        Log::error('Error checking expiring medicines', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
    }
}
}
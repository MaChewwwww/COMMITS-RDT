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

    private function createNotification($title, $message, $type, $userIds, $medicineId)
    {
        try {
            $notification = Notification::create([
                'title' => $title,
                'message' => $message,
                'type' => $type,
                'reference_id' => $medicineId
            ]);

            // Attach users to the notification using pivot table
            $notification->users()->attach($userIds);

            Log::info('Successfully created notification', [
                'notification_id' => $notification->id,
                'type' => $type
            ]);

            return $notification;
        } catch (\Exception $e) {
            Log::error("Error creating {$type} notification", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    private function checkExpiringMedicines()
    {
        try {
            $today = Carbon::today('Asia/Manila');
            $userIds = User::pluck('id')->toArray();

            Log::info('Starting medicine expiry check', [
                'today' => $today->format('Y-m-d'),
                'users' => count($userIds)
            ]);

            $medicines = Medicine::whereNotNull('expiration_date')
                ->whereHas('box', function($query) {
                    $query->where('isReturned', 0);
                })
                ->get();

            Log::info('Found medicines to check', ['count' => $medicines->count()]);

            foreach ($medicines as $medicine) {
                $expiryDate = Carbon::parse($medicine->expiration_date)->startOfDay();
                $daysRemaining = $today->diffInDays($expiryDate);

                Log::info('Checking medicine', [
                    'id' => $medicine->id,
                    'name' => $medicine->medicine_name,
                    'expiry_date' => $expiryDate->format('Y-m-d'),
                    'days_remaining' => $daysRemaining
                ]);

                // Monthly notification (8-30 days)
                if ($daysRemaining <= 30 && $daysRemaining > 7 && !$medicine->notified_monthly) {
                    try {
                        $this->createNotification(
                            'Medicine Expiring in a Month',
                            "{$medicine->medicine_name} will expire in {$daysRemaining} " .
                            ($daysRemaining == 1 ? 'day' : 'days') . " (on " .
                            $expiryDate->format('M d, Y') . ")",
                            'warning',
                            $userIds,
                            $medicine->id
                        );

                        $medicine->notified_monthly = true;
                        $medicine->save();
                    } catch (\Exception $e) {
                        Log::error('Error creating monthly notification', [
                            'error' => $e->getMessage(),
                            'trace' => $e->getTraceAsString()
                        ]);
                    }
                }

                // Weekly notification (2-7 days)
                if ($daysRemaining <= 7 && $daysRemaining >= 1 && !$medicine->notified_weekly) {
                    try {
                        $this->createNotification(
                            'Medicine Expiring This Week',
                            "{$medicine->medicine_name} will expire in {$daysRemaining} " .
                            ($daysRemaining == 1 ? 'day' : 'days') . " (on " .
                            $expiryDate->format('M d, Y') . ")",
                            'danger',
                            $userIds,
                            $medicine->id
                        );

                        $medicine->notified_weekly = true;
                        $medicine->save();
                    } catch (\Exception $e) {
                        Log::error('Error creating weekly notification', [
                            'error' => $e->getMessage(),
                            'trace' => $e->getTraceAsString()
                        ]);
                    }
                }

                // Daily Missed (< 0 day)
                if ($daysRemaining < 0 && !$medicine->notified_today) {
                    try {
                        $this->createNotification(
                            'Medicine Has Expired',
                            "{$medicine->medicine_name} has expired on " . $expiryDate->format('M d, Y') .
                            " and is not usable anymore. Please dispose of properly.",
                            'deleted',
                            $userIds,
                            $medicine->id
                        );

                        $medicine->notified_today = true;
                        $medicine->save();
                    } catch (\Exception $e) {
                        Log::error('Error creating expired notification', [
                            'error' => $e->getMessage(),
                            'trace' => $e->getTraceAsString()
                        ]);
                    }
                }

                // Daily notification (0 day)
                if ($daysRemaining == 0 && !$medicine->notified_today) {
                    try {
                        $this->createNotification(
                            'Medicine Expiring Today',
                            "{$medicine->medicine_name} will expire today (" . $expiryDate->format('M d, Y') . ")",
                            'deleted',
                            $userIds,
                            $medicine->id
                        );

                        $medicine->notified_today = true;
                        $medicine->save();
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

    public function superadminDashboard ()
    {
        $total_users = User::all()->count();
        $total_active_users = User::where('status', 'active')->count();
        $total_inactive_users = User::where('status', 'inactive')->count();

        return view('SuperAdmin.Superadmin_dashboard', compact('total_users','total_active_users','total_inactive_users'));
    }
}

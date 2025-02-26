<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Medicine;
use App\Models\Supply;
use App\Models\Equipment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
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
            ->limit(10)  // Changed from 5 to 10
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
            'equipmentStatus'
        ));
    }
}

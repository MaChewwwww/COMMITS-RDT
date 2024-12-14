<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientRecord;
use Carbon\Carbon;

class PatientRecordController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientRecord::query();
        
        // Filter by healed status (required)
        $query->where('status', 'healed');
        
        // Filter by identity if selected
        $identityFilter = $request->input('identity');
        if ($identityFilter) {
            $query->where('identity', $identityFilter);
        }
        
        // Filter by month name if selected
        if ($request->has('month') && $request->input('month') !== null) {
            $monthFilter = $request->input('month');
            
            // Validate the month filter
            $request->validate([
                'month' => 'nullable|string|in:January,February,March,April,May,June,July,August,September,October,November,December',
            ]);
            
            // Convert the month name to a month number (e.g., "January" => "01")
            $monthNumber = Carbon::parse($monthFilter)->format('m');
            
            // Filter records by month part of the discharge_date using whereMonth()
            $query->whereMonth('discharge_date', $monthNumber);
        }
        
        // Retrieve records and format the start_date and discharge_date
        $records = $query->get()->map(function($record) {
            $record->formatted_start_date = Carbon::parse($record->start_date)->format('F j, Y'); // Format start_date as 'Month Day, Year'
            $record->formatted_discharge_date = Carbon::parse($record->discharge_date)->format('F j, Y'); // Format discharge_date as 'Month Day, Year'
            return $record;
        });
        
        // Generate month options for the dropdown
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        
        // Return the view with filtered records and month options for the dropdown
        return view('patient_records.index', [
            'records' => $records,
            'identityFilter' => $identityFilter,
            'months' => $months,
            'selectedMonth' => $request->input('month'),
        ]);
    }
}

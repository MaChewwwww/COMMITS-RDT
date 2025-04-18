<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Carbon\Carbon;

class PatientHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::query();

        // Check if a month is selected
        if ($request->filled('month')) {
            $monthFilter = $request->input('month');

            // Validate month input
            $request->validate([
                'month' => 'nullable|string|in:January,February,March,April,May,June,July,August,September,October,November,December',
            ]);

            // Convert month name to number
            $monthNumber = Carbon::createFromFormat('F', $monthFilter)->month;
            $query->whereMonth('created_at', $monthNumber);

            // If a week is also selected, apply week filter within the selected month
            if ($request->filled('week')) {
                $weekFilter = $request->input('week');

                // Validate week input
                $request->validate([
                    'week' => 'nullable|integer|min:1|max:5',
                ]);

                // Apply filtering to get only the records for the specific week in the selected month
                $query->whereRaw("
                    WEEK(created_at, 1) - WEEK(DATE_SUB(created, INTERVAL DAYOFMONTH(created_at)-1 DAY), 1) + 1 = ?
                ", [$weekFilter]);
            }
        }

        // Sort records by created_at (newest first)
        $records = $query->orderBy('created_at', 'desc')->get()->map(function ($record) {
            $record->formatted_start_date = Carbon::parse($record->start_date)->format('F j, Y');
            $record->formatted_discharge_date = Carbon::parse($record->created_at)->format('F j, Y');
            return $record;
        });

        // Generate month options
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        // Generate week options dynamically (1-5)
        $weeks = range(1, 5);

        return view('History.all', [
            'records' => $records,
            'months' => $months,
            'weeks' => $weeks,
            'selectedMonth' => $request->input('month'),
            'selectedWeek' => $request->input('week'),
        ]);
    }
}

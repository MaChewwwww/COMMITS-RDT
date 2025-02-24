<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Report::query(); 
        
        if ($request->has('type')) { 
            switch ($request->type) { 
                # Filter reports based on this week e.g Monday to Friday
                case 'weekly': 
                    $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]); 
                    break; 
                # Filter reports based on this month e.g December
                case 'monthly': 
                    $query->whereMonth('created_at', now()->month)
                          ->whereYear('created_at', now()->year); 
                    break;
                # Filter reports based on this year e.g 2024 
                case 'yearly': 
                    $query->whereYear('created_at', now()->year); 
                    break; 
                default: 
                    break; 
            } 
        } 

        $reports = $query->orderBy('created_at', 'desc')->get();

        return view('report.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('report.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        Report::create([
            'date' => now(),
            'title' => $request->title,
        ]);

        return redirect()->route('report.index')->with('success', 'Report created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        return view('report.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('report.index')->with('success', 'Report deleted successfully.');
    }
}
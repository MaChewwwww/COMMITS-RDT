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

        // Filter by category if provided
        if ($request->has('category')) {
            $category = $request->input('category');
            $query->where('category', $category);
        }

        // Get all reports
        $reports = $query->get();
        
        return view('reports.index', compact('reports'));
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
            'contents' => 'required',
            'category' => 'required',
        ]);

        // Create a new report
        Report::create([
            'title' => $request->title,
            'contents' => $request->contents,
            'category' => $request->category,
        ]);

        return redirect()->route('report.index')->with('success', 'Report added successfully.');
    }

    // Show a single report
    public function show($id)
    {
        $report = Report::findOrFail($id);

        return view('reports.show', compact('report'));
    }

    // Delete a report
    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();
        return redirect()->route('report.index')->with('success', 'Report deleted successfully.');
    }
}
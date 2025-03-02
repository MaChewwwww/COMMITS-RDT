<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportPaper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportsExport;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Report::query();
        
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // Filter by month (based on the 'date' column) for the current year
        if ($request->has('month')) {
            $query->whereMonth('date', $request->month)
                ->whereYear('date', now()->year);
        }

        // Use pagination instead of get()
        $reports = $query->orderBy('date', 'desc')->paginate(10);

        // to pass the services array to the view
        $services = $this->getDefaultServices();

        return view('reports.index', compact('reports'), compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'name' => 'required',
            'age' => 'required',
            'sex' => 'required',
            'complaint' => 'required',
            'diagnosis' => 'required',
            'remarks' => 'nullable',
            'category' => 'required',
        ]);

        // Create a new report
        Report::create([
            'title' => $request->title,
            'name' => $request->name,
            'age' => $request->age,
            'sex' => $request->sex,
            'complaint' => $request->complaint,
            'diagnosis' => $request->diagnosis,
            'remarks' => $request->remarks,
            'category' => $request->category,
            'date' => Carbon::today(),
        ]);

        return redirect()->route('reports.index')->with('success', 'Report added successfully.');
    }

    // Show a single report
    public function show($id)
    {
        $report = Report::findOrFail($id);

        return view('reports.show', compact('report'));
    }
    // update report
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'      => 'required',
            'name'       => 'required',
            'age'        => 'required',
            'sex'        => 'required',
            'complaint'  => 'required',
            'diagnosis'  => 'required',
            'remarks'    => 'nullable',
            'category'   => 'required',
        ]);

        $report = Report::findOrFail($id);

        $report->update($request->all());

        return redirect()->route('reports.index')
                        ->with('success', 'Report updated successfully.');
    }

    // Delete a report
    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Report deleted successfully.');
    }

    public function showReportPaper(){

        $services = $this->getDefaultServices();
        
        return view('reports.reportPaper', compact('services'));
    }

    public function filterAndCountReports(Request $request)
    {
        $request->validate([
            'fromDurationDate' => 'required|date',
            'toDurationDate'   => 'required|date',
        ]);
        
        // Convert the incoming date strings to Carbon instances and ensure they cover the full day.
        $from = Carbon::parse($request->input('fromDurationDate'))->startOfDay();
        $to = Carbon::parse($request->input('toDurationDate'))->endOfDay();

        // Query the reports table for reports created between $from and $to,
        // grouping by 'diagnosis' and 'category', and counting how many reports are in each group.
        $results = Report::whereBetween('date', [$from, $to])
            ->select('diagnosis', 'category', DB::raw('COUNT(*) as report_count'))
            ->groupBy('diagnosis', 'category')
            ->get();

        $services = $this->getDefaultServices();
        
        $categoryMapping = [
            'students'       => 0,
            'faculty'        => 1,
            'administrative' => 2,
            'dependents'     => 3,
            'visitors'       => 4
        ];

        // Loop over the query results and update your services array
        foreach ($results as $result) {
            foreach ($services as &$service) {
                if ($service['name'] === $result->diagnosis) {
                    $cat = strtolower($result->category);
                    if (isset($categoryMapping[$cat])) {
                        $index = $categoryMapping[$cat];
                        $service['data'][$index] = $result->report_count;
                    }
                }
            }
        }

        // Return the results as JSON (or pass them to a view)
        return response()->json($services);
    }

    // to initialize the services array once
    private function getDefaultServices(): array {
        return [
            [
                'name' => '1. Consultation / Treatment',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'A. Respiratory Disorder',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '1. URTI',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'a. T/C URTI',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'b. Allergic Rhinitis',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'c. T/C Allergic Pharyngitis',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'd. T/C Allergic Rhinitis',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '1.2 LRTI',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'a. PTB III',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'b. CAP, low risk',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'c. Acute Bronchitis',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'd. PTB IV',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'e. PTB V',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '2. Bronchial Asthma',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'B. Digestive / GI DIsorder',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '1. T/C Age',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '2. AGE',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '3. R/O AGE',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '4. APD',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '5. T/C PUP',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'C. Genitourinary Tract Disorder',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '1. UTI',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '2. Genital tract infection',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '3. Other genitourinary disorder',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '4. Kidney disease',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '5. Genitourinary tract cancers',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'L. Viral Infections',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '1. SVI',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '2. T/C SVI',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '3. R/O SVI',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'M. Dermatologic Disorder',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '1. Expidermal inclusion Cyst, S/P removal',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '2. Beginning Blister Formation, Achilles Area, Left',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '3. Hypersensitivity Reaction Type 12 to Food',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'N. Surgery / Trauma',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '1. Mericle Strain with conclusion hematoma 2\' to Fall',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '2. Incised wound, 1st Digit, Left Hand',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '3. Conclusion Hematoma, Right Wrist',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '4. Infected Wound, Right Elbow',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '5. S/P Appendectomy',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'O. Vitamin / Mineral Deficiency',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'P. Dental',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '1. Dental Caries',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'Q. Others',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '1. T/C Generalized Anxiety Disorder',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '2. T/C Acute Anxiety Reaction',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => '3. T/C Otherstatic hypotension',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'R. E/N at the time of Examination',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'T/C AGE, R/O Amoebiasis',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'LGTB rpob, 2th to Hemorrhoids, R/O Colonic Pathology',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'HCVD: CKD Stage 4-5',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'T/C Allergic Pharyngitis',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'T/C SVI',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'T/C Tenssion Headache',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'R/O Leptospirosis',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'APD',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'T/C HTN',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'HTN 2',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'Muscle Strain, LS area',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'UTI',
                'data' => ['', '', '', '', '', '']
            ],
            [
                'name' => 'Total Online Consults',
                'data' => ['', '', '', '', '', '']
            ],
        ];
    }

    public function exportExcel(Request $request)
    {
        // will get the count values of each category and services
        $tableDatas = $request->input('tableData') 
        ? json_decode($request->input('tableData'), true) 
        : $this->getDefaultServices();
        
        // Prepare data for the export view
        $data = [
            'title' => $request->title,
            'fromDate' => $request->from_date,
            'toDate' => $request->to_date,
            'physicianName' => $request->physician_name,
            'submissionDate' => $request->submissionDate,
            'tableDatas' => $tableDatas,
            'f2fConsultMale' => $request->f2f_male,
            'f2fConsultFemale' => $request->f2f_female,
            'f2fConsultTotal' => $request->f2f_male + $request->f2f_female,
            'onlineConsultMale' => $request->online_male,
            'onlineConsultFemale' => $request->online_female,
            'onlineConsultTotal' => $request->online_male + $request->online_female,
            'grandTotalMale' => $request->f2f_male + $request->online_male,
            'grandTotalFemale' => $request->f2f_female + $request->online_female,
            'grandTotal' => $request->f2f_male + $request->f2f_female + $request->online_male + $request->online_female,
            'campusPhysician' => $request->physician_name,
            'campusNurse' => $request->nurse_name
        ];
        
        return Excel::download(new ReportsExport($data), 'medical_report.xlsx');
    }
}
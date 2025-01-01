<?php

namespace App\Http\Controllers;

<<<<<<< Updated upstream
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function edit()
    {

    }

    // add isDeleted boolean first
    public function destroy()
    {

    }
=======
use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    public function index() {
        $patients = Patient::all();

        return view('patient.patients', compact('patients'));
    }
    
    public function add() {
        return view('patient.add');
    }

    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'sex' => 'required|in:Male,Female',
            'year_course_dept' => 'nullable|string|max:255',
            'contactDetails' => 'required|string|max:255',
            'patient_status' => 'required|string|max:255',
            'patientType' => 'required|in:Student,Faculty,Admin,Visitor,Dependent',
            'user_id' => 'nullable|exists:users,id',
            'student_number' => 'nullable|string|max:255',
        ]);

        // Create a new patient
        $patient = Patient::create($validated);

        // Redirect back or to another page
        return redirect()->route('patients')->with('success', 'Patient added successfully!');
    }

    public function update(Request $request, $id)
    {
        // Find patient by ID
        $patient = Patient::findOrFail($id);

        // Validate input
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'sex' => 'required|in:Male,Female',
            'year_course_dept' => 'nullable|string|max:255',
            'contactDetails' => 'required|string|max:255',
            'patient_status' => 'required|string|max:255',
            'patientType' => 'required|in:Student,Faculty,Admin,Visitor,Dependent',
            'user_id' => 'nullable|exists:users,id',
            'student_number' => 'nullable|string|max:255',
        ]);

        $patient->update([
            'fullname'  => $request->input('fullname'),
            'sex' => $request->input('sex'),
            'year_course_dept' => $request->input('year_and_section'),
            'contactDetails' => $request->input('contactDetails'),
            'patient_status' => $request->input('patient_status'),
            'patientType' => $request->input('patientType'),
            'user_id' => $request->input('user_id'),
            'student_number'  => $request->input('student_number'),
        ]);

        // Redirect back or to another page
        return redirect()->route('patients')->with('success', 'Patient updated successfully!');
    }

    public function destroy($id)
    {
        // Find patient by ID
        $patient = Patient::findOrFail($id);

        // Delete patient
        $patient->delete();

        // Redirect back or to another page
        return redirect()->route('patients')->with('success', 'Patient deleted successfully!');
    }

    public function edit($id)
    {
        $patient = Patient::findOrFail($id);  // Retrieve the patient by ID
        return view('patient.edit', compact('patient'));  // Pass the patient data to the view
    }

        


>>>>>>> Stashed changes
}

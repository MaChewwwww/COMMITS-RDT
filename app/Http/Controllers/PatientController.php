<?php

namespace App\Http\Controllers;

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
        try {
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

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Patient added successfully!'
                ]);
            }

            return redirect()->route('patients')->with('success', 'Patient added successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'errors' => $e->errors()
                ], 422);
            }

            throw $e;
        }
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        try {
            $validated = $request->validate([
                'fullname' => 'required|string|max:255',
                'sex' => 'required|string|max:255',
                'year_course_dept' => 'nullable|string|max:255',
                'contactDetails' => 'required|string|max:255',
                'patient_status' => 'required|string|max:255',
                'patientType' => 'required|in:Student,Faculty,Admin,Visitor,Dependent',
                'user_id' => 'nullable|exists:users,id',
                'student_number' => 'nullable|string|max:255',
            ]);

            $patient->update($validated);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Patient updated successfully!'
                ]);
            }

            return redirect()->route('patients')->with('success', 'Patient updated successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'errors' => $e->errors()
                ], 422);
            }

            throw $e;
        }
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


}

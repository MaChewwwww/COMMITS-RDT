<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\User;
use App\Models\Medicine;
use App\Models\PrescriptionMedicine;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::with('physician')->get();
        $physicians = User::where('role', 'admin')->get(); // Only get admin users      
        $medicines = Medicine::whereHas('box', function ($query) {
            $query->where('isReturned', 0);
        })->get(); // Query all medicines where box is not returned
        
        return view('patient.patients', compact('patients', 'physicians', 'medicines'));
    }

    public function add() {
        return view('patient.add');
    }

    public function create()
    {
        $physicians = User::where('role', 'admin')->get(); // Update create method too
        return view('patient.add', compact('physicians'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'fullname' => 'required|string|max:255',
                'sex' => 'required|in:Male,Female',
                'year_course_dept' => 'required|string|max:255',
                'contactDetails' => 'required|string|max:255',
                'patient_status' => 'required|string',
                'patientType' => 'required|in:Student,Faculty,Admin,Visitor,Dependent',
                'student_number' => 'nullable|required_if:patientType,Student|string|max:255',
                'physician_id' => 'required|exists:users,id,role,admin'
            ]);

            $patient = Patient::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Patient added successfully',
                'data' => $patient
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Patient creation error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while adding the patient.'
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Find the patient by ID
            $patient = Patient::findOrFail($id);
            
            $validated = $request->validate([
                'fullname' => 'required|string|max:255',
                'sex' => 'required|in:Male,Female',
                'year_course_dept' => 'nullable|string|max:255',
                'contactDetails' => 'required|string|max:255',
                'patient_status' => 'required|string',
                'patientType' => 'required|in:Student,Faculty,Admin,Visitor,Dependent',
                'student_number' => 'nullable|required_if:patientType,Student|string|max:255',
                'physician_id' => 'required|exists:users,id'
            ]);

            // Use DB transaction
            DB::beginTransaction();
            
            $patient->update($validated);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Patient updated successfully',
                'data' => $patient->fresh()
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the patient.'
            ], 500);
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

    public function edit(Patient $patient)
    {
        $physicians = User::where('role', 'admin')->get(); // Update edit method too
        return view('patient.edit', compact('patient', 'physicians'));
    }



    /**
     * Store a new prescription
     */
    public function storePrescription(Request $request)
    {
        try {
            $request->validate([
                'patient_id' => 'required|exists:patients,id',
                'medicine_id' => 'required|exists:medicines,id',
                'quantity' => 'required|integer|min:1',
                'instructions' => 'nullable|string'
            ]);

            DB::beginTransaction();

            $medicine = Medicine::findOrFail($request->medicine_id);

            if ($medicine->remaining_quantity < $request->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => "Insufficient quantity available for {$medicine->medicine_name}"
                ], 422);
            }

            $prescription = PrescriptionMedicine::create([
                'patient_id' => $request->patient_id,
                'medicine_id' => $request->medicine_id,
                'quantity' => $request->quantity,
                'instructions' => $request->instructions
            ]);

            $medicine->remaining_quantity -= $request->quantity;
            $medicine->consumed_quantity += $request->quantity;
            $medicine->save();

            DB::commit();

            // Load the prescription with its relationships for the response
            $prescription->load(['medicine', 'patient']);

            return response()->json([
                'success' => true,
                'message' => 'Prescription created successfully',
                'prescription' => $prescription,
                'remaining_quantity' => $medicine->remaining_quantity
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create prescription: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get prescriptions for a patient
     */
    public function getPrescriptions(Patient $patient)
    {
        $prescriptions = $patient->prescriptionMedicines()
            ->with('medicine')
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'prescriptions' => $prescriptions
        ]);
    }
}

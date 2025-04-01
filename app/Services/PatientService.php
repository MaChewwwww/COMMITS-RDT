<?php

namespace App\Services;

use App\Models\Patient;
use App\Models\Medicine;
use App\Models\PrescriptionMedicine;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PatientService
{
    /**
     * Create a new patient
     *
     * @param array $data
     * @return \App\Models\Patient
     */
    public function createPatient(array $data)
    {
        return Patient::create($data);
    }

    /**
     * Update an existing patient
     *
     * @param \App\Models\Patient $patient
     * @param array $data
     * @return \App\Models\Patient
     */
    public function updatePatient(Patient $patient, array $data)
    {
        $patient->update($data);
        return $patient->fresh();
    }

    /**
     * Delete a patient
     *
     * @param \App\Models\Patient $patient
     * @return bool
     */
    public function deletePatient(Patient $patient)
    {
        return $patient->delete();
    }

    /**
     * Create a new prescription for a patient
     *
     * @param array $data
     * @return array
     * @throws \Exception
     */
    public function createPrescription(array $data)
    {
        // Find the medicine
        $medicine = Medicine::findOrFail($data['medicine_id']);
        
        // Check if sufficient quantity is available
        if ($medicine->remaining_quantity < $data['quantity']) {
            throw new \Exception("Insufficient quantity available. Only {$medicine->remaining_quantity} {$medicine->unit} of {$medicine->medicine_name} remaining.");
        }

        // Create the prescription
        $prescription = PrescriptionMedicine::create([
            'patient_id' => $data['patient_id'],
            'medicine_id' => $data['medicine_id'],
            'quantity' => $data['quantity'],
            'instructions' => $data['instructions'] ?? null
        ]);

        // Update medicine quantities
        $medicine->remaining_quantity -= $data['quantity'];
        $medicine->consumed_quantity += $data['quantity'];
        $medicine->save();

        // Load relationships
        $prescription->load(['medicine', 'patient']);

        return [
            'prescription' => $prescription,
            'medicine' => [
                'id' => $medicine->id,
                'name' => $medicine->medicine_name,
                'remaining_quantity' => $medicine->remaining_quantity,
                'unit' => $medicine->unit
            ]
        ];
    }

    /**
     * Get patient prescriptions
     *
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPatientPrescriptions(Patient $patient)
    {
        return $patient->prescriptionMedicines()
            ->with('medicine')
            ->latest()
            ->get();
    }

    /**
     * Execute a database transaction
     *
     * @param \Closure $callback
     * @return mixed
     * @throws \Exception
     */
    public function executeTransaction(\Closure $callback)
    {
        DB::beginTransaction();
        
        try {
            $result = $callback();
            DB::commit();
            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Transaction failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
}
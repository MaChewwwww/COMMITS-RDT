<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'sex',
        'year_course_dept',
        'contactDetails',
        'patient_status',
        'patientType',
        'student_number',
        'physician_id',
    ];

    // Add relationship method for physician
    public function physician()
    {
        return $this->belongsTo(User::class, 'physician_id');
    }

    /**
     * Get all prescriptions for the patient.
     */
    public function prescriptionMedicines()
    {
        return $this->hasMany(PrescriptionMedicine::class);
    }

    /**
     * Get all medicines prescribed to the patient.
     */
    public function medicines()
    {
        return $this->belongsToMany(Medicine::class, 'prescription_medicine')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}

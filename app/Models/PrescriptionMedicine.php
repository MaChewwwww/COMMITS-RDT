<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrescriptionMedicine extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'prescription_medicine';

    protected $fillable = [
        'patient_id',
        'medicine_id',
        'quantity'
    ];

    /**
     * Get the patient that owns the prescription medicine.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the medicine associated with the prescription.
     */
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
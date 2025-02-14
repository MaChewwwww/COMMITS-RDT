<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalClearance extends Model
{
    use HasFactory; // Enables model factories (optional, remove if not needed)
    protected $table = 'medical_clearances';

    // Fields that can be mass-assigned
    protected $fillable = [
        'document_id', // Foreign key to associate with the Document model
        'date',
        'patient_name',
        'vaccination_status',
        'remarks',
        'doctorName',
        'position',
        'license_number',
        'document_type',
        'additional_date',
        'additional_patient_name',
        'additional_vaccination_status',
        'additional_remarks',
        'additional_doctorName',
        'additional_position',
    ];

    // Define the relationship with the Document model
    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
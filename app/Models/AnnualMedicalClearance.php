<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnnualMedicalClearance extends Model
{
    use HasFactory; // Enables model factories (optional, remove if not needed)
    protected $table = 'annual_medical_clearances';

    protected $fillable = [
        'document_id',
        'date',
        'patient_name',
        'startDate',
        'endDate',
        'doctorName',
        'license_number',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalCertificate extends Model
{
    use HasFactory;
    
    protected $table = 'medical_certificates';

    protected $fillable = [
        'document_id',
        'date',
        'patient_name',
        'sickness',
        'startDate',
        'endDate',
        'reason',
        'doctorName',
        'document_type',
        'additional_date',
        'additional_patient_name',
        'additional_sickness',
        'additional_startDate',
        'additional_endDate',
        'additional_reason',
        'additional_doctorName',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
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
        'clearance_type',
        'date',
        'patient_name',
        'sickness',
        'startDate',
        'endDate',
        'reason',
        'doctorName',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
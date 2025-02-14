<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WaiverForPulmonaryCase extends Model
{
    use HasFactory;
    protected $table = 'waiver_for_pulmonary_cases'; 
    
    protected $fillable = [
        'patient_name',
        'collegeName',
        'year',
        'followUpDate',
        'document_id',
        'document_type',
        'additional_patient_name',
        'additional_collegeName',
        'additional_year',
        'additional_followUpDate',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }
}
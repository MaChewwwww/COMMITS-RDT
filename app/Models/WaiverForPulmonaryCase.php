<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class WaiverForPulmonaryCase extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'waiver_for_pulmonary_cases'; 
    
    protected $fillable = [
        'patient_name',
        'collegeName',
        'date',
        'year',
        'followUpDate',
        'document_id',
        'document_type',
        'control_number',
        'revision',
        'date_issued',
        'additional_date',
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
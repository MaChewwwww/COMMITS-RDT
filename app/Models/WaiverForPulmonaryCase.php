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
    ];

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Waiver extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'waiver'; 
    
    protected $fillable = [
        'date',
        'name',
        'collegeName',
        'department',
        'diagnosedDate',
        'diagnosedIllness',
        'followUpDate',
        'doctorName',
        'document_id',
        'document_type',
        'additional_date',
        'additional_name',
        'additional_collegeName',
        'additional_department',
        'additional_diagnosedDate',
        'additional_diagnosedIllness',
        'additional_followUpDate',
        'additional_doctorName',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }
}
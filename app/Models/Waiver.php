<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Waiver extends Model
{
    use HasFactory;
    protected $table = 'waiver'; 
    
    protected $fillable = [
        'date',
        'name',
        'collegeName',
        'department',
        'diagnosedDate',
        'diagnosedIllness',
        'followUpDate',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }
}
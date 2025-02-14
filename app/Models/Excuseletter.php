<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Excuseletter extends Model
{
    use HasFactory;
    protected $table = 'excuseletter'; 
    
    protected $fillable = [
        'document_type',
        'date', 
        'recipient', 
        'patient_name', 
        'department', 
        'excuse_for', 
        'cause', 
        'doctorName',
        'document_id',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }
}
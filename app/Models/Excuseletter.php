<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Excuseletter extends Model
{
    use HasFactory;
    protected $table = 'excuseletter'; 
    
    protected $fillable = [
        'phone_number',
        'date',
        'patient_name',
        'excuse_for',
        'cause',
        'doctorName',
        'document_id',
        'address',
        'document_type',
        'date_today',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }
}
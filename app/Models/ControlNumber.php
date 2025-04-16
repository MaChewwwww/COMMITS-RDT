<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_type',
        'control_number',
        'revision',
        'date_issued',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'sex',
        'year_course_dept',
        'contactDetails',
        'patient_status',
        'patientType',
        'student_number',
        'physician_id',
        // make sure all fields you're updating are listed here
    ];

    // Add relationship method for physician
    public function physician()
    {
        return $this->belongsTo(User::class, 'physician_id');
    }
}

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
        'user_id',
        'student_number',
    ];
}

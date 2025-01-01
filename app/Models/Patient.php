<?php

namespace App\Models;

<<<<<<< Updated upstream
use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
>>>>>>> Stashed changes
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
<<<<<<< Updated upstream
    use HasFactory;

    protected $fillable = [
        'firstName',
        'lastName',
        'middleName',
        'patientType',
        'dateOfBirth',
        'diseaseSeverity',
        'patientStatus',
        'contactDetails',
        'address',
        'registrationDate',
        'isFullyHealed',
        'assignedDoctorPhysician'
=======
    //

    protected $fillable = [
        'fullname',
        'sex',
        'year_course_dept',
        'contactDetails',
        'patient_status',
        'patientType',
        'user_id',
>>>>>>> Stashed changes
    ];
}

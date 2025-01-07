<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientRecord extends Model
{
    // Specify the attributes that can be mass-assigned
    protected $fillable = ['patient_name', 'status', 'identity', 'start_date', 'discharge_date'];

    // Accessor to format dates into the "January 5, 2024" format when retrieved
    public function getStartDateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('F j, Y');
    }

    public function getDischargeDateAttribute($value)
    {
        return $value ? \Carbon\Carbon::parse($value)->format('F j, Y') : null;
    }

    // Mutator to store dates in the "Y-m-d" format when saved
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
    }

    public function setDischargeDateAttribute($value)
    {
        $this->attributes['discharge_date'] = $value ? \Carbon\Carbon::parse($value)->format('Y-m-d') : null;
    }
}

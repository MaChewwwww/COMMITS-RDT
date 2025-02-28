<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{   
    use SoftDeletes;
    protected $table = 'reports';

    protected $fillable = [
        'title', 
        'name', 
        'age', 
        'sex', 
        'complaint', 
        'diagnosis', 
        'remarks', 
        'category',
        'date'
    ];

}
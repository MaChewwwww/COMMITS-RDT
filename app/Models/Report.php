<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';

    protected $fillable = [
        'date',
        'title',
        'type',
        'identifier',
        'copy',
        'contents',
    ];
}
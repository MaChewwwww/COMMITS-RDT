<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'message',
        'type',
        'users_id',
        'viewed_by',
        'reference_id'
    ];

    protected $casts = [
        'users_id' => 'array',
        'viewed_by' => 'array'
    ];
}

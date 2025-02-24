<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicine extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'medicine_name',
        'unit',
        'initial_quantity',
        'consumed_quantity',
        'remaining_quantity',
        'expiration_date',
        'box_id',
        'status',
        'user_id'
    ];

    protected $casts = [
        'expiration_date' => 'datetime',
        'initial_quantity' => 'double',
        'remaining_quantity' => 'double',
        'consumed_quantity' => 'double',
        'deleted_at' => 'datetime'
    ];

    protected $table = 'medicines';

    // Relationships
    public function box()
    {
        return $this->belongsTo(Boxes::class, 'box_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

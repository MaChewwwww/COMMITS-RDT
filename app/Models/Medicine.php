<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_name',
        'initial_quantity',
        'consumed_quantity',
        'remaining_quantity',
        'unit',
        'expiration_date',
        'box_id',
        'status'
    ];

    protected $table = 'medicines'; 
    public function box()
    {
        return $this->belongsTo(Boxes::class, 'box_id');
    }
}

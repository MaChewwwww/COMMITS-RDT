<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_name',
        'description',
        'initial_quantity',
        'consumed_quantity',
        'remaining_quantity',
        'unit_of_measurement',
        'expiration_date',
        'box_id'
    ];

    protected $table = 'medicines'; 
    public function box()
    {
        return $this->belongsTo(Boxes::class, 'box_id');
    }
}

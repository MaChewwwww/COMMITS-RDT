<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boxes extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date_received',
        'box_name', 
        'description',
        'status',
        'supplier_name',
    ];

    /**
     * Get the medicine associated with the box.
     */
    public function medicine()
    {
        return $this->hasOne(Medicine::class, 'box_id');
    }
}

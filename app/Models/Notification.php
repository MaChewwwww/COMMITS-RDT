<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Notification extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'message',
        'type',
        'reference_id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('viewed_at')
            ->withTimestamps();
    }
}

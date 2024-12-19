<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    private static function generateUniqueDocumentId()
    {
        do {
            // Generate a random unique identifier (e.g., UUID or a numeric ID)
            $documentId = Str::uuid(); // Replace with numeric if preferred, e.g., rand(1000, 9999)
        } while (self::where('document_id', $documentId)->exists());

        return $documentId;
    }

    public function excuseletter()
    {
        return $this->hasOne(ExcuseLetter::class, 'document_id');
    }
    
}

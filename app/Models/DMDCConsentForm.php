<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DMDCConsentForm extends Model
{
    use HasFactory; // Enables model factories (optional, remove if not needed)
    protected $table = 'dmdc_consent_forms';

    protected $fillable = [
        'document_id',
        'eventName',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
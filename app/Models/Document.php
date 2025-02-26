<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Document extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'document_type',
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
    
    public function medicalcertificate()
    {
        return $this->hasOne(MedicalCertificate::class, 'document_id');
    }

    public function medicalclearance()
    {
        return $this->hasOne(MedicalClearance::class, 'document_id');
    }

    public function annualmedicalclearance()
    {
        return $this->hasOne(AnnualMedicalClearance::class, 'document_id');
    }

    public function dmdcconsentform()
    {
        return $this->hasOne(DMDCConsentForm::class, 'document_id');
    }

    public function waiver()
    {
        return $this->hasOne(Waiver::class, 'document_id');
    }

    public function waiverforpulmonarycase()
    {
        return $this->hasOne(WaiverForPulmonaryCase::class, 'document_id');
    }
}

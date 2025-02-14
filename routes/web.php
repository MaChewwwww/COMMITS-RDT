<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientHistoryController;
use App\Http\Controllers\DocumentController;

// Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// Patient History
Route::get('/history', [PatientHistoryController::class, 'index'])->name('HISTORY.all');

// Document Routes
Route::prefix('documents')->group(function () {
    Route::get('/', [DocumentController::class, 'adocument_file'])->name('documents.adocument_file');

    // Routes for each document type
    $documentTypes = [
        'excuse_letter' => 'Excuse Letter',
        'medical_clearance' => 'Medical Clearance',
        'medical_certificate' => 'Medical Certificate',
        'annual_medical_clearance' => 'Annual Medical Clearance',
        'waiver' => 'Waiver',
        'waiver_for_pulmonary_case' => 'Waiver for Pulmonary Case',
        'dmdc_consent_form' => 'DMDC Consent Form',
    ];

foreach ($documentTypes as $slug => $type) {
    // Create Document
    Route::get("/create/{$slug}", [DocumentController::class, 'create'])
        ->name("documents.{$slug}.create")
        ->defaults('document_type', $type);

    // Store Document
    Route::post("/store/{$slug}", [DocumentController::class, 'store'])
        ->name("documents.{$slug}.store")
        ->defaults('document_type', $type);

    // Edit Document
    Route::get("/{id}/edit/{$slug}", [DocumentController::class, 'edit'])
        ->name("documents.{$slug}.edit")
        ->defaults('document_type', $type);

    // Update Document
    Route::put("/{id}/update/{$slug}", [DocumentController::class, 'update'])
        ->name("documents.{$slug}.update")
        ->defaults('document_type', $type);

    // View Document (new route)
    Route::get("/{id}/view/{$slug}", [DocumentController::class, 'view'])
        ->name("documents.{$slug}.view")
        ->defaults('document_type', $type);
}

});

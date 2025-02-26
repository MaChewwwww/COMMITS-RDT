<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PatientHistoryController;
use App\Http\Controllers\DocumentController;


// Guest routes
Route::middleware(['guest'])->group(function () {
    // Default landing
    Route::get('/', function () {
        return redirect()->route('login.show');
    });

    Route::get('/login', [UserController::class, 'showLogin'])->name('login.show');
    Route::post('/login', [UserController::class, 'login'])->name('login');
});

// Protected routes
Route::middleware(['auth'])->group(function () {

    Route::prefix('patients')->group(function () {

        // Route::get('/', [PatientController::class, "index"])->name('patients');

        // Show all patients (index page)
        Route::get('/', [PatientController::class, 'index'])->name('patients');

        // Show form to add a new patient
        Route::get('/new', [PatientController::class, 'add'])->name('patients.add');

        // Store a new patient
        Route::post('/store', [PatientController::class, 'store'])->name('patients.store');

        // Show the edit form for a specific patient
        Route::get('/edit/{id}', [PatientController::class, 'edit'])->name('patients.edit');

        // Update a patient record
        Route::put('/update/{id}', [PatientController::class, 'update'])->name('patients.update');

        // Delete a patient record
        Route::delete('/destroy/{id}', [PatientController::class, 'destroy'])->name('patients.destroy');
    });

    // Medicine routes
    Route::prefix('medicine')->group(function () {
        Route::get('/', [MedicineController::class, 'index'])->name('medicine_dashboard');
        Route::get('/add', [MedicineController::class, 'add'])->name('add_medicine');
        Route::post('/', [MedicineController::class, 'store'])->name('add_medicine_store');
        Route::get('/{medicine}/edit', [MedicineController::class, 'edit'])->name('edit_medicine');
        Route::put('/{medicine}/update', [MedicineController::class, 'update'])->name('update_medicine');
        Route::put('/{medicine}/deduct', [MedicineController::class, 'deduct'])->name('deduct_medicine');
        Route::delete('/medicines/{medicine}', [MedicineController::class, 'delete'])->name('delete_medicine');
    });

    // Logout route
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

#Report -Camar
Route::get('/reports', [ReportController::class, 'index'])->name('reports');

Route::prefix('reports')->group(function () {

    // Display a list of reports, allowing filters
    Route::get('/', [ReportController::class, 'index'])->name('report.index');

    // Show a single report
    Route::get('/{id}', [ReportController::class, 'show'])->name('report.show');

    // Store a new report
    Route::post('/', [ReportController::class, 'store'])->name('report.store');

    // Delete a report
    Route::delete('/{id}', [ReportController::class, 'destroy'])->name('report.destroy');
});

// Patient History
Route::get('/history', [PatientHistoryController::class, 'index'])->name('History.all');

// Document Routes
Route::prefix('documents')->group(function () {
    Route::get('/', [DocumentController::class, 'index'])->name('documents.index');

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

    Route::delete("/{id}/delete/{$slug}", [DocumentController::class, 'softDelete'])
        ->name("documents.{$slug}.delete")
        ->defaults('document_type', $type);
    
}

});

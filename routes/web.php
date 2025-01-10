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
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [UserController::class, 'login'])->name('login');

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Default landing
    Route::get('/', function () {
        return view('welcome');
    });

    Route::prefix('patient')->group(function () {

        Route::get('/', [PatientController::class, "index"])->name('patients');

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
    });

    // Logout route
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

#Report -Camar
Route::get('/reports', [ReportController::class, 'index']);

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

// Route for patient history
Route::get('/history.backend', [PatientHistoryController::class, 'index'])->name('patient_history.index');
// Route for document
Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
Route::get('/documents/{id}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
Route::get('/documents/{id}/view', [DocumentController::class, 'show'])->name('documents.view');
Route::put('/documents/{id}', [DocumentController::class, 'update'])->name('documents.update');



//History
Route::prefix('history')->group(function () {

    Route::get('/', function () {
        return view('HISTORY.all');
    });

    Route::get('/student', function () {
        return view('HISTORY.student');
    });

    Route::get('/faculty', function () {
        return view('HISTORY.faculty');
    });

    Route::get('/visitor', function () {
        return view('HISTORY.visitor');
    });

    Route::get('/dependent', function () {
        return view('HISTORY.dependent');
    });

    //Documents
    Route::get('/', function () {
        return view('Documents.adocument_file');
    });

    // Specific document views
    Route::get('/med_certif', function () {
        return view('Documents.med_certif');
    });

    Route::get('/med_clear', function () {
        return view('Documents.med_clear');
    });

    Route::get('/annual_med_clear', function () {
        return view('Documents.annual_med_clear');
    });

    Route::get('/excuse_letter', function () {
        return view('Documents.excuse_letter');
    });

    Route::get('/waiver', function () {
        return view('Documents.waiver');
    });

    Route::get('/waiver_for_pulm', function () {
        return view('Documents.waiver_for_pulm');
    });

    Route::get('/dmdc_consent_form', function () {
        return view('Documents.dmdc_consent_form');
    });
});


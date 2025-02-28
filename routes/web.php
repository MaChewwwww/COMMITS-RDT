<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PatientHistoryController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProfileController;

// Guest routes
Route::middleware(['guest'])->group(function () {
    // Default landing
    Route::get('/', function () {
        return redirect()->route('login.show');
    });

    Route::get('/login', [UserController::class, 'showLogin'])->name('login.show');
    Route::post('/login', [UserController::class, 'login'])->name('login');
    
    // Forgot password route
    Route::view('/forgot-password', 'authentication.forgot-password')->name('password.request');

    // Validate the email and send the password reset link to the corresponding email/user
    Route::post('/forgot-password', [ForgotPasswordController::class, 'passwordEmail']);

    // Reset password route
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'passwordReset'])->name('password.reset');

    // Validate the password reset request and update the password
    Route::post('/reset-password', [ForgotPasswordController::class, 'passwordUpdate'])->name('password.update');
});

// Authenticated routes
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

    // Report routes
    Route::prefix('reports')->group(function () {
        // Display a list of reports, allowing filters
        Route::get('/', [ReportController::class, 'index'])->name('reports.index');
        // Show a single report
        Route::get('/{id}', [ReportController::class, 'show'])->name('reports.show');
        // Store a new report
        Route::post('/', [ReportController::class, 'store'])->name('reports.store');
        // Delete a report
        Route::delete('/{id}', [ReportController::class, 'destroy'])->name('reports.destroy');
        Route::get('/{id}/edit', [ReportController::class, 'edit'])->name('reports.edit');
        Route::put('/{id}', [ReportController::class, 'update'])->name('reports.update');
    });

    // Report paper route
    Route::get('/reportPaper', [ReportController::class, 'showReportPaper'])->name('reports.showReportPaper');
    Route::post('/reportPaper', [ReportController::class, 'filterAndCountReports'])->name('reports.filterAndCountReports');

    //History routes
    Route::get('/history', [PatientHistoryController::class, 'index'])->name('patient_history.index');
    Route::prefix('history')->group(function () {
        Route::get('/', function () {
            return view('HISTORY.all');
        })->name('history.show');
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

    // Document routes
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/{id}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
    Route::get('/documents/{id}/view', [DocumentController::class, 'show'])->name('documents.view');
    Route::put('/documents/{id}', [DocumentController::class, 'update'])->name('documents.update');

    // Profile routes
    Route::prefix('profile')->group(function () {
        Route::get('/accountSettings', [ProfileController::class, 'accountSettings'])->name('profile.accountSettings');
        Route::get('/helpAndSupport', [ProfileController::class, 'helpAndSupport'])->name('profile.helpAndSupport');
        Route::post('/accountSettings', [ProfileController::class, 'updateProfile'])->name('profile.updateProfile');
        Route::post('/updatePassword', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    });

});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\EquipmentController;
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
    // User Logout route
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');


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


    // INVENTORY
    Route::prefix('inventory')->group(function () {
        Route::get('/', function () {
            return redirect()->route('inventory-medicines');
        })->name('inventory');

        // Medicines
        Route::prefix('medicines')->group(function () {
            Route::controller(MedicineController::class)->group(function () {
                Route::get('/', 'index')->name('inventory-medicines');
                Route::post('/', 'store')->name('add_medicine_store');
                Route::put('/{medicine}/update', 'update')->name('update_medicine');
                Route::put('/{medicine}/deduct', 'deduct')->name('deduct_medicine');
                Route::delete('/medicines/{medicine}', 'destroy')->name('delete_medicine');
            });           
        });

        // Supplies
        Route::prefix('supplies')->group(function () {
            Route::controller(SupplyController::class)->group(function () {
                Route::get('/', 'index')->name('inventory-supplies');
                Route::post('/', 'store')->name('add_supply_store');
                Route::put('/{supply}/update', 'update')->name('update_supply');
                // Route::put('/{supply}/deduct', 'deduct')->name('deduct_supply');
                Route::delete('/supplies/{supply}', 'destroy')->name('delete_supply');
            });   
        });

        // Equipment
        Route::prefix('equipment')->group(function () {
            Route::controller(EquipmentController::class)->group(function () {
                Route::get('/', 'index')->name('inventory-equipment');
                Route::post('/', 'store')->name('add_equipment_store');
                Route::put('/{equipment}/update', 'update')->name('update_equipment');
                // Route::put('/{equipment}/deduct', 'deduct')->name('deduct_equipment');
                Route::delete('/equipment/{equipment}', 'destroy')->name('delete_equipment');
            }); 
        });
    });
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

// Route for patient history
Route::get('/history', [PatientHistoryController::class, 'index'])->name('patient_history.index');

// Route for document
Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
Route::get('/documents/{id}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
Route::get('/documents/{id}/view', [DocumentController::class, 'show'])->name('documents.view');
Route::put('/documents/{id}', [DocumentController::class, 'update'])->name('documents.update');



//History
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


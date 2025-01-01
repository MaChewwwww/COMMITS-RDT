<?php

use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

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

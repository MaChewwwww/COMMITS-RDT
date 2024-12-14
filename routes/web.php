<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientRecordController;

// Existing route for the welcome page
Route::get('/', function () {
    return view('welcome');
});

// New route for patient records
Route::get('/patient-records', [PatientRecordController::class, 'index'])->name('patient_records.index');


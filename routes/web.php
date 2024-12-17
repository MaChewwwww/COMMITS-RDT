<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientHistoryController;

// Existing route for the welcome page
Route::get('/', function () {
    return view('welcome');
});

// New route for patient records
Route::get('/patient-records', [PatientHistoryController::class, 'index'])->name('patient_history.index');


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientHistoryController;
use App\Http\Controllers\DocumentController;

// Existing route for the welcome page
Route::get('/', function () {
    return view('welcome');
});

// Route for patient history
Route::get('/history', [PatientHistoryController::class, 'index'])->name('patient_history.index');
// Route for document
Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
Route::get('/documents/{id}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
Route::get('/documents/{document_id}/view', [DocumentController::class, 'show'])->name('documents.view');
Route::put('/documents/{document_id}', [DocumentController::class, 'update'])->name('documents.update');


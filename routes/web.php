<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientHistoryController;
use App\Http\Controllers\DocumentController;

// Existing route for the welcome page
Route::get('/', function () {
    return view('welcome');
});

// Route for patient history
Route::get('/history', [PatientHistoryController::class, 'index'])->name('HISTORY.all');
// Route for document
Route::get('/documents', [DocumentController::class, 'adocument_file'])->name('documents.adocument_file');
Route::get('/documents/{id}/edit', [DocumentController::class, 'edit'])->name('documents.excuse_letter.edit');
Route::get('/documents/{id}/view', [DocumentController::class, 'show'])->name('documents.view');
Route::put('/documents/{id}', [DocumentController::class, 'update'])->name('documents.update');
Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.excuse_letter.create');
Route::post('/documents', [DocumentController::class, 'store'])->name('documents.excuse_letter.store');


<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// Display a list of reports, allowing filters
Route::get('/', [ReportController::class, 'index'])->name('report.index');

// Show a single report
Route::get('/reports/{id}', [ReportController::class, 'show'])->name('report.show');

// Store a new report
Route::post('/reports', [ReportController::class, 'store'])->name('report.store');

// Delete a report
Route::delete('/reports/{id}', [ReportController::class, 'destroy'])->name('report.destroy');


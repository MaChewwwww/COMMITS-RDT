<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MedicineController;


// Guest routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [UserController::class, 'login'])->name('login');

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Default landing
    Route::get('/', function () {
        return view('welcome');
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

// Display a list of reports, allowing filters
Route::get('/', [ReportController::class, 'index'])->name('report.index');

// Show a single report
Route::get('/reports/{id}', [ReportController::class, 'show'])->name('report.show');

// Store a new report
Route::post('/reports', [ReportController::class, 'store'])->name('report.store');

// Delete a report
Route::delete('/reports/{id}', [ReportController::class, 'destroy'])->name('report.destroy');



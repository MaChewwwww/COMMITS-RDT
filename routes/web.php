<?php

use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/medicine', [MedicineController::class, 'index'])->name('medicine_dashboard');
Route::get('/medicine/add', [MedicineController::class, 'add'])->name('add_medicine');
Route::post('/medicine', [MedicineController::class, 'store'])->name('add_medicine_store');
Route::get('/medicine/{medicine}/edit', [MedicineController::class, 'edit'])->name('edit_medicine');
Route::put('/medicine/{medicine}/update', [MedicineController::class, 'update'])->name('update_medicine');
Route::put('/medicine/{medicine}/deduct', [MedicineController::class, 'deduct'])->name('deduct_medicine');

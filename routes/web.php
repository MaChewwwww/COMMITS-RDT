<?php

use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('patient')->group(function () {

    Route::get('/', [PatientController::class, "index"])->name('patients');

});

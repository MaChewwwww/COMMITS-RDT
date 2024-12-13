<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

# Will make the index the default page
Route::get('/', [ReportController::class, 'index']);

Route::resource('report', ReportController::class);
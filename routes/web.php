<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Auth routes
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
});

// default landing
Route::get('/', function () {
    return view('welcome');
});

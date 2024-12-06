<?php

use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [GuestController::class, 'showLogin'])->name('login.show');

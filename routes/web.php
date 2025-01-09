<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Duplicate routes create conflicts.

Route::get('/', function () {
    return view('home');
});

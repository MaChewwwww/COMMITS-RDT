<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('HISTORY.all');
});

Route::get('/all', function () {
    return view('HISTORY.all');
});

Route::get('/student', function () {
    return view('HISTORY.student');
});

Route::get('/faculty', function () {
    return view('HISTORY.faculty');
});

Route::get('/visitor', function () {
    return view('HISTORY.visitor');
});

Route::get('/dependent', function () {
    return view('HISTORY.dependent');
});




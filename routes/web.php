<?php

use Illuminate\Support\Facades\Route;

//History
    Route::get('/', function () {
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

//Documents
    Route::get('/', function () {
        return view('Documents.adocument_file');
    });

    // Specific document views
    Route::get('/med_certif', function () {
        return view('Documents.med_certif');
    });

    Route::get('/med_clear', function () {
        return view('Documents.med_clear');
    });

    Route::get('/annual_med_clear', function () {
        return view('Documents.annual_med_clear');
    });

    Route::get('/excuse_letter', function () {
        return view('Documents.excuse_letter');
    });

    Route::get('/waiver', function () {
        return view('Documents.waiver');
    });

    Route::get('/waiver_for_pulm', function () {
        return view('Documents.waiver_for_pulm');
    });

    Route::get('/dmdc_consent_form', function () {
        return view('Documents.dmdc_consent_form');
    });

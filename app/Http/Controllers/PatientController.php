<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function edit()
    {

    }

    // add isDeleted boolean first
    public function destroy()
    {

    }
}

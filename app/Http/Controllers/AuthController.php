<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     *  Display login form
     */
    public function showLogin()
    {
        return view('authentication.login');
    }
}

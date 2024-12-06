<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Return login form
     */

    public function showLogin()
    {
        return view('authentication.login');
    }
}

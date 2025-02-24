<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     *  Display login form
     */
    public function showLogin()
    {
        return view('authentication.login');
    }


    /**
     *  Handle user login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication successful
            $user = Auth::user(); // Get authenticated user

            if ($user->role === 'standard')
            {
                // Check user role and redirect accordingly
                return $user->role === 'admin'
                    ? redirect()->route('patients') // if admin
                    : redirect()->route('patients');
            }
        }

        // Authentication failed
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    /**
     *  Handle user logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // redirect to login page
        return redirect()->route('login');
    }
}

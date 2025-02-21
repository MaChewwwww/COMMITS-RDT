<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPredefinedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Define the predefined user's credentials
        $predefinedUser = [
            'email' => 'admin@example.com',
            'password' => 'secure_password_123',
        ];

        // Check if the user is logged in and matches the predefined user
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->email == $predefinedUser['email'] && $user->password == $predefinedUser['password']) {
                return $next($request); // Allow the request to proceed if it matches
            }
        }

        // Redirect to home or show an error page if the user is not authorized
        return redirect()->route('home')->with('error', 'You are not authorized to access this page.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
            'password' => 'required|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication successful
            $user = Auth::user(); // Get authenticated user

            // check if first time login and update certain details
            if (!$user->is_activated && $user->status == "inactive") {
                $user->is_activated = true;
                $user->status = "active";

                $user->save();
            }

            // Check user role and redirect accordingly
            return $user->role === 'superadmin'
                ? redirect()->route('Superadmin_dashboard') // if superadmin
                : redirect()->route('dashboard');
        }

        // Authentication failed
        return redirect()->back()->withErrors(['password' => 'Invalid credentials']);
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

    /**
     *  Return User management page
     */
    public function getUsers()
    {
        $users = User::paginate(20);

        return view('SuperAdmin.users.index', compact('users'));
    }

    /**
     *  Store new user
     */
    public function store(Request $request)
    {
        $user = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'role' => 'required|in:standard,superadmin'
        ]);

        // Generate a random string for password
        $generatedPassword = Str::random(8) . rand(100, 999) . Str::random(1) . '!@#';
        $generatedPassword = str_shuffle($generatedPassword);

        $user['password'] = Hash::make($generatedPassword);

        // create user and store the user for sending email
        $created_user = User::create($user);

        if ($created_user) {
            // send the credentials to the respective email
            Mail::to($created_user->email)->send(new WelcomeMail($created_user->first_name, $created_user->email, $generatedPassword));

            return redirect()->back()->with('success', 'User added successfully.');
        } else {

            return redirect()->back()->with('error', 'Creation of account failed.');
        }
    }

    /**
     *  Update user info
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'status' => 'required|in:active,,inactive,suspended,deactivated',
        ]);

        $user = User::find($request->id);

        $isUpdated = $user->update([
            'status' => $request->status,
        ]);

        if ($isUpdated) {
            return redirect()->back()->with('success', 'User details updated successfully.');
        } else {

            return redirect()->back()->with('error', 'Failed to update user details.');
        }
    }

    /**
     *  Delete an account
     */
    public function delete(Request $request)
    {
        $request->validate([
            'delete_user_id' => 'required|exists:users,id',
        ]);

        $userToDelete = User::find($request->delete_user_id);

        if ($userToDelete) {

            $userToDelete->update([
                'status' => 'deactivated',
            ]);

            $userToDelete->delete();

            return redirect()->back()->with('success', 'User deleted successfully');
        }
        return redirect()->back()->with('error', 'Failed to delete user');
    }
}

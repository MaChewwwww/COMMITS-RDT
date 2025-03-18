<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function accountSettings(Request $request)
    {
        $id = Auth::user()->id; // get logged in user id
        $Data = User::find($id); // finds logged in user id
        return view('profile.accountSettings', compact('Data'));
    }

    public function changePassword(Request $request)
    {
        $id = Auth::user()->id; // get logged in user id
        $Data = User::find($id); // finds logged in user id
        return view('profile.changePassword', compact('Data'));
    }

    public function updateProfile(Request $request)
    {
        $id = Auth::user()->id; // get logged in user id
        $Data = User::find($id); // finds logged in user id
        $Data->first_name = $request->first_name;
        $Data->last_name = $request->last_name;

        if($Data->first_name == null || $Data->last_name == null){
            return redirect()->back()->with('error', 'First Name and Last Name is required');
        }

        if ($request->hasFile('profile_image')){
            $request->validate([
                'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $del = 'uploads/users/'.$Data->profile_image;
            if (File::exists($del)) {
                File::delete($del);
            }

            $file = $request->file('profile_image');
            $exe = $file->getClientOriginalExtension();
            $filename = '_profile'.microtime().'.'.$exe;
            $file->move('uploads/users/', $filename);
            $Data->profile_image = $filename;
        }

        $Data->save();
        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function updatePassword(Request $request){

        $validator = Validator::make($request->all(), [
            'currentPassword' => 'required',
            'newPassword' => 'required|min:8',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first('newPassword'));
        }

        $HashPassword = Auth::user()->password;

        if (Hash::check($request->currentPassword, $HashPassword)) { // Check if current password is correct
    
            // Check if the new password is the same as the current password
            if (Hash::check($request->newPassword, $HashPassword)) {
                return redirect()->back()->with('error', 'New Password cannot be the same as current password');
            }
    
            $user = User::find(Auth::id());
            $user->password = bcrypt($request->newPassword);
            $user->save();
    
            session()->flash('success', 'Password updated successfully');
            return redirect()->back();
    
        } else {
            session()->flash('error', 'Current password is incorrect');
            return redirect()->back();
        }
    }
}
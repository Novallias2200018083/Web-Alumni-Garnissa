<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class InviteRegisterController extends Controller
{
    public function completeRegistration($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user || $user->is_active) {
            return redirect()->route('login');  // Redirect if the user is already registered
        }

        return view('auth.complete-registration', compact('user'));
    }

    public function postCompleteRegistration(Request $request, $email)
    {
        $user = User::where('email', $email)->first();

        if (!$user || $user->email_verified_at !== null) {
            return redirect()->route('login');
        }

        // Validate and set the password
        $validated = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Update the user's password and mark them as verified
        $user->password = bcrypt($validated['password']);
        $user->email_verified_at = now();  // Set the verification timestamp
        $user->save();

        return redirect()->route('login')->with('success', 'Registration complete. You can now log in.');
    }

}


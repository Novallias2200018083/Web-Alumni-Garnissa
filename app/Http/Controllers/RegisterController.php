<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
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

        if (!$user || $user->is_active) {
            return redirect()->route('login');
        }

        // Validate and set the password
        $validated = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = bcrypt($validated['password']);
        $user->is_active = true;  // Set user as active once registration is complete
        $user->save();

        return redirect()->route('login')->with('success', 'Registration complete. You can now log in.');
    }
}


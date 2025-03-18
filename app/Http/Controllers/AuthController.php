<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login'); // Create this view
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'identifier' => 'required', // Can be email or pin_code
            'password' => 'required',
        ]);

        $fieldType = filter_var($credentials['identifier'], FILTER_VALIDATE_EMAIL) ? 'email' : 'pin_code';

        if (Auth::attempt([$fieldType => $credentials['identifier'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            // **Check if the user needs to change their password**
            if (Auth::user()->must_change_password) {
                return redirect()->route('password.change'); // Redirect to password change page
            }

            return redirect()->intended('/');
        }

        return back()->withErrors(['login' => 'Invalid credentials.']);
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function showChangePasswordForm()
    {
        return view('auth.change-password'); // Ensure this view exists
    }

    // Handle Password Change Request
    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()
                ->route('login')
                ->withErrors(['error' => 'User not found. Please log in again.']);
        }

        // Debugging: Log User Data
        Log::info('Debugging User Data: ' . json_encode($user));

        // Ensure we get the latest user data
        $user = \App\Models\User::find(Auth::id());

        if (!$user) {
            return redirect()
                ->route('login')
                ->withErrors(['error' => 'User record not found in database.']);
        }

        // Debugging Again
        Log::info('User Exists in Database: ' . json_encode($user));

        // Update password & remove must_change_password flag
        $user->password = Hash::make($request->password);
        $user->must_change_password = false;

        if ($user->save()) {
            // Log the user out to ensure they sign in with their new password
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('success', 'Password changed successfully! Please log in again.');
        } else {
            return back()->withErrors(['error' => 'Failed to update password.']);
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ForcePasswordChange
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Debugging: Log the must_change_password status
            Log::info("Checking must_change_password for User ID: {$user->id}, Value: {$user->must_change_password}");

            // If must_change_password is still true, force the user to change it
            if ($user->must_change_password == true) {
                // Allow only the change-password and logout routes
                if (!$request->is('change-password') && !$request->is('logout')) {
                    return redirect()->route('password.change')->with('error', 'You must change your password before accessing the system.');
                }
            }
        }

        return $next($request);
    }
}

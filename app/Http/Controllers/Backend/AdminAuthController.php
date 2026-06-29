<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    /**
     * SHOW ADMIN LOGIN FORM
     */
    public function showLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('backend.auth.login'); // views/backend/auth/login.blade.php
    }

    /**
     * PROCESS ADMIN LOGIN
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Explicitly pointing to the admin guard
        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Welcome to the Control Panel!');
        }

        return back()->withErrors([
            'email' => 'The provided administrator credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * PROCESS ADMIN LOGOUT
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        // Standard session invalidation steps
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Logged out successfully!');
    }
}
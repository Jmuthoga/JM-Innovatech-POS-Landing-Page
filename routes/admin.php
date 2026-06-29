<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminAuthController;

// GUEST ADMIN ROUTES
Route::middleware('guest:admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    
    // Forgot / Reset Password stubs can go here
});

// AUTHENTICATED ADMIN ROUTES
Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('backend.dashboard.index'); // maps to views/backend/dashboard/index.blade.php
    })->name('dashboard');

    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});
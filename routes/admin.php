<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminAuthController;
use App\Http\Controllers\Backend\Category\CategoryController;
use App\Http\Controllers\Backend\Brand\BrandController;
use App\Http\Controllers\Backend\Product\ProductController;

// GUEST ADMIN ROUTES
Route::middleware('guest:admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    
    // Forgot / Reset Password stubs can go here
});

// AUTHENTICATED ADMIN ROUTES
Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('backend.dashboard.index');
    })->name('dashboard');

    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // CATEGORY ROUTES
    Route::get('categories/data', [CategoryController::class, 'getData'])->name('categories.data');
    Route::resource('categories', CategoryController::class);

    // BRAND ROUTES
    Route::get('brands/data', [BrandController::class, 'getData'])->name('brands.data');
    Route::resource('brands', BrandController::class);

    // PRODUCT ROUTES
    Route::get('products/data', [ProductController::class, 'getData'])->name('products.data');
    Route::resource('products', ProductController::class);
});
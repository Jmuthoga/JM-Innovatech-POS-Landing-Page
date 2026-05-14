<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/shop', [HomeController::class, 'shop'])->name('shop');

// NEW: Product Details Page
Route::get('/product/{id}', [HomeController::class, 'product'])->name('product.show');

Route::get('/cart', [HomeController::class, 'cart'])->name('cart.index');

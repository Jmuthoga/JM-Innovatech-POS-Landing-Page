<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CustomerController;
use App\Http\Controllers\Frontend\PosSystemController;

// FRONTEND HOME ROUTES
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/product/{id}', [HomeController::class, 'product'])->name('product.show');

 //MINI CART ACTIONS (ALLOWED WITHOUT LOGIN)
Route::post('/cart/add', [HomeController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/increase/{id}', [HomeController::class, 'increaseCart'])->name('cart.increase');
Route::post('/cart/decrease/{id}', [HomeController::class, 'decreaseCart'])->name('cart.decrease');
Route::delete('/cart/{id}', [HomeController::class, 'removeFromCart'])->name('cart.remove');

//WISHLIST
Route::post('/wishlist/add', [HomeController::class, 'addToWishlist'])->name('wishlist.add');
Route::delete('/wishlist/{id}', [HomeController::class, 'removeFromWishlist'])->name('wishlist.remove');
Route::post('/wishlist/move/{id}', [HomeController::class, 'moveWishlistToCart'])->name('wishlist.move.single');
Route::post('/wishlist/move-all', [HomeController::class, 'moveAllWishlistToCart'])->name('wishlist.move.all');

    //LOGIN REDIRECT HELPERS
// CART
Route::get('/cart-login-redirect', function () {
    session(['url.intended' => route('cart.index')]);
    return redirect()->route('login');
})->name('cart.login.redirect');

// CHECKOUT
Route::get('/checkout-login-redirect', function () {
    session(['url.intended' => route('checkout')]);
    return redirect()->route('login');
})->name('checkout.login.redirect');


// CUSTOMER ACCOUNT
Route::get('/account-login-redirect', function () {
    session(['url.intended' => route('customer.account')]);
    return redirect()->route('login');
})->name('account.login.redirect');

// POS SYSTEM INFORMATION PAGES
Route::prefix('pos')->group(function () {
    Route::get('/features', [PosSystemController::class, 'features'])->name('pos.features');
    Route::post('/contact', [PosSystemController::class, 'storeContact'])->name('pos.contact');
    Route::get('/pricing', [PosSystemController::class, 'pricing'])->name('pos.pricing');
    Route::get('/customers', [PosSystemController::class, 'customers'])->name('pos.customers');
    Route::get('/about', [PosSystemController::class, 'about'])->name('pos.about');
    Route::get('/support', [PosSystemController::class, 'support'])->name('pos.support');
    Route::get('/retail-pos', [PosSystemController::class, 'retailPos'])->name('pos.retail');
    Route::get('/inventory-management', [PosSystemController::class, 'inventoryManagement'])->name('pos.inventory');
    Route::get('/multi-branch', [PosSystemController::class, 'multiBranch'])->name('pos.multi_branch');
    Route::get('/mpesa-integration', [PosSystemController::class, 'mpesaIntegration'])->name('pos.mpesa');
    Route::get('/ecommerce-integration', [PosSystemController::class, 'ecommerceIntegration'])->name('pos.ecommerce');
    Route::get('/barcode-support', [PosSystemController::class, 'barcodeSupport'])->name('pos.barcode');
    Route::get('/receipt-printing', [PosSystemController::class, 'receiptPrinting'])->name('pos.receipt');
    Route::get('/loyalty-system', [PosSystemController::class, 'loyaltySystem'])->name('pos.loyalty');
});

//CUSTOMER AUTHENTICATION (GUEST ONLY)
Route::middleware(['guest'])->group(function () {
    //LOGIN
    Route::get('/login', [CustomerController::class, 'showLogin'])->name('login');
    Route::post('/login', [CustomerController::class, 'login'])->name('login.submit');

    //SIGNUP
    Route::get('/signup', [CustomerController::class, 'showSignup'])->name('signup');
    Route::post('/signup/stage', [CustomerController::class, 'processSignupStage'])->name('signup.stage');
    Route::post('/signup/verify-otp', [CustomerController::class, 'verifyOtp'])->name('signup.verify_otp');

    //FORGOT PASSWORD
    Route::get('/forgot-password', [CustomerController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [CustomerController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [CustomerController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [CustomerController::class, 'resetPassword'])->name('password.update');
});

//AUTHENTICATED CUSTOMER ROUTES
Route::middleware(['auth'])->group(function () {
    //FULL CART (LOGIN REQUIRED)
    Route::get('/cart', [HomeController::class, 'cart'])->name('cart.index');

    //CHECKOUT (LOGIN REQUIRED)
    Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
    Route::match(['get', 'post'], '/checkout/apply-promo', [HomeController::class, 'applyPromo'])->name('checkout.apply_promo');
    Route::post('/checkout/process', [HomeController::class, 'checkoutProcess'])->name('checkout.process');

    //PAYMENT (LOGIN REQUIRED)
    Route::get('/checkout/payment', [HomeController::class, 'paymentPage'])->name('checkout.payment');
    Route::post('/checkout/payment/submit', [HomeController::class, 'paymentSubmit'])->name('checkout.payment.submit');

    //CUSTOMER ACCOUNT
    Route::get('/customer/account', [CustomerController::class, 'account'])->name('customer.account');
    Route::post('/customer/profile/update', [CustomerController::class, 'updateProfile'])->name('customer.profile.update');
    Route::post('/customer/password/update', [CustomerController::class, 'updatePassword'])->name('customer.password.update');

    //LOGOUT
    Route::post('/logout', [CustomerController::class, 'logout'])->name('logout');
});

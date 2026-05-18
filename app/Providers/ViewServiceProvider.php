<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {

            $cart = session()->get('cart', []);
            $wishlist = session()->get('wishlist', []);

            $view->with([
                'miniCart' => $cart,
                'miniCartCount' => collect($cart)->sum('qty'),
                'miniSubtotal' => collect($cart)->sum(fn($i) => $i['price'] * $i['qty']),

                'wishlist' => $wishlist,
                'wishlistCount' => count($wishlist),

                // ✅ FIX ONCE AND FOR ALL
                'categoriesList' => Category::orderBy('name')->pluck('name')->all(),
            ]);
        });
    }
}
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Automatically shares $wishlist with all views dynamically
        View::composer('*', function ($view) {
            $view->with('wishlist', session()->get('wishlist', []));
        });
    }
}

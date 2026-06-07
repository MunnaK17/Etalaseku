<?php

namespace App\Providers;

use App\Http\ViewComposers\StoreViewComposer;
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
        // Auto-provide $store to all views using seller and wallet layouts
        View::composer(['layouts.seller', 'layouts.admin', 'wallet.*'], StoreViewComposer::class);
    }
}
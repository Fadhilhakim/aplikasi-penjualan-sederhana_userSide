<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\header;
use App\View\Components\navbar;
use App\View\Components\recomendation;
use App\View\Components\products;

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
        Blade::component('x-header', Header::class);
        Blade::component('x-navbar', Navbar::class);
        Blade::component('x-recomendation', recomendation::class);
        Blade::component('x-products', products::class);
    }
}

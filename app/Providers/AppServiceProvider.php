<?php

namespace App\Providers;

// use Illuminate\Contracts\Pagination\Paginator;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
        $lang = LaravelLocalization::setLocale();
        config::set('openweather.lang', $lang);

        // Model::unguard();
        // to unuse $fillable again in model
        Paginator::useTailwind();
    }
}
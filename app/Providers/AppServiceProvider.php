<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        //
        $theme = \App\Models\Theme::first();
        view()->share('title', 'SweetiePieBakeco');
        view()->share('keywords', 'SweetiePieBakeco');
        view()->share('description', 'SweetiePieBakeco');
        view()->share('theme', $theme->theme_code ?? 'theme-1');

    }
}



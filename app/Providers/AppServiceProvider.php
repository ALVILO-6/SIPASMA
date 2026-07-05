<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\AdvoStruktur;

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
        // Restart server = Session user yang sebelumnya login akan otomatis restart juga.
        // AdvoStruktur::where('logged_in',true)->update(['logged_in' => false]);
    }
}

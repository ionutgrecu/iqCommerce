<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('production')) {
            error_reporting(0);
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
            \Debugbar::enable();
        }        
    }
}

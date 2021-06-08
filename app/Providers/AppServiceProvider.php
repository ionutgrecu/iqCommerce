<?php

namespace App\Providers;

use App\Services\BreadcrumbsService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use function app;
use function env;

class AppServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        if (env('production')) {
            error_reporting(0);
        } else {
            error_reporting(E_ALL ^ E_NOTICE);
            \Debugbar::enable();
        }

        app()->singleton(BreadcrumbsService::class, function ($app) {
            return new BreadcrumbsService();
        });

        Paginator::defaultView('vendor.pagination.default');
    }

}

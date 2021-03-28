<?php

namespace App\Providers;

use App\Services\CategoryCharacteristicsService;
use App\Services\ProductCategoriesService;
use App\Services\ProductCharacteristicsService;
use App\Services\ProductsService;
use App\Services\ProductVendorsService;
use Illuminate\Support\ServiceProvider;
use function app;

class ShopServiceProvider extends ServiceProvider {

    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        app()->bind('ProductCategoriesService', ProductCategoriesService::class);
        app()->bind('CategoryCharacteristicsService', CategoryCharacteristicsService::class);
        app()->bind('ProductVendorsService', ProductVendorsService::class);
        app()->bind('ProductsService', ProductsService::class);
        app()->bind('ProductsCharacteristics', ProductCharacteristicsService::class);
    }

}

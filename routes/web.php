<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::patterns([
    'wildcard' => '(.*)?',
    'lang' => '^[a-z]{2}|[a-z]{2}\-[a-z]{2}$',
]);

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('/', [AdminController::class, 'index']);
    Route::any('/products', [ProductsController::class, 'index'])->name('admin.products');
});
//
//Route::group(['middleware' => 'auth'], function() {
//    
//});

Route::group(['middleware' => 'web'], function() {
//    Route::get('/', function () {
//        return view('welcome');
//    });
    Route::get('/', [PagesController::class, 'index'])->name('home');
    Route::get('/despre-proiect', [PagesController::class, 'about'])->name('home.about');
    Route::get('/contact', [PagesController::class, 'about'])->name('home.contact');

    Route::group(['prefix' => 'shop','name'=>'shop.'], function() {
        Route::get('/{cat_slug}-{cat_id}', [ShopController::class, 'category'])->name('shop.category');
        Route::get('/{cat_slug}-{cat_id}/{prod_slug}-{prod_id}', [ShopController::class, 'product'])->name('shop.product');
    });
});

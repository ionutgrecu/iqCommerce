<?php

use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\CharacteristicsController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\ResourcesController;
use App\Http\Controllers\Api\VendorsController;
use Illuminate\Support\Facades\Route;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' => 'v1', 'middleware' => ['auth', 'api']], function() {
    Route::group(['prefix' => 'products'], function() {
        Route::resource('/resources', ResourcesController::class);
        Route::resource('/categories', CategoriesController::class);
        Route::resource('/vendors', VendorsController::class);
        Route::resource('/characteristics', CharacteristicsController::class);
        Route::delete('products/image/{id}', [ProductsController::class, 'deleteImage']);
        Route::resource('/products', ProductsController::class);
    });
});

<?php

use Illuminate\Support\Facades\Route;

Route::patterns([
    'wildcard' => '(.*)?',
    'lang' => '^[a-z]{2}|[a-z]{2}\-[a-z]{2}$',
]);

Route::group(['prefix' => 'admin','middleware'=>'admin'], function() {
    Route::get('/','App\Http\Controllers\Admin\AdminController@index');
    Route::any('/products','App\Http\Controllers\Admin\ProductsController@index')->name('admin.products');
});
//
//Route::group(['middleware' => 'auth'], function() {
//    
//});

Route::group(['middleware' => 'web'],function() {
//    Route::get('/', function () {
//        return view('welcome');
//    });
    Route::get('/', 'App\Http\Controllers\PagesController@index')->name('home');
});

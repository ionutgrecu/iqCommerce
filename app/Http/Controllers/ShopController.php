<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    function category($slug,...$args){
        $catId=$args[0];
        return "category $catId";
    }
    
    function product(...$params){
        dd($params);
        return "product $prodId";
    }
}

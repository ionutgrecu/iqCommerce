<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    function category($slug){
        $catId=slugToId($slug);
        return "category $catId";
    }
    
    function product($slug){
        $prodId=slugToId($slug);
        return "product $prodId";
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model {

    use HasFactory;

    protected $guarded = ['id'];
    
    function cart(){
        return $this->belongsTo(Cart::class);
    }
    
    function product(){
        return $this->hasOne(Product::class,'id','product_id');
    }

}

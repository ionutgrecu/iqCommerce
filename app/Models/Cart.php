<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    
    function items(){
        return $this->hasMany(CartItem::class);
    }
}

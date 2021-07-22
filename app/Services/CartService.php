<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Auth;
use Session;

class CartService {

    private string $sessionId;
    private Cart|null $cart;

    public function __construct(string $sessionId = null) {
        $this->sessionId = $sessionId ?? Session::getId();

        $this->cart = Cart::where('session_id', $this->sessionId)->first();

        if (!$this->cart && Auth::user())
            $this->cart = Cart::where('user_id', Auth::user()->id)->first();

        if (!$this->cart)
            $this->cart = new Cart;
        
        $this->cart->fill([
                'user_id' => Auth::user() ? Auth::user()->id : null,
                'session_id' => $this->sessionId,
            ]);

        $this->cart->saveIfDirty();
    }
    
    function addToCart(Product $product, float $qty){
        $cartItem= CartItem::firstOrNew([
            'cart_id'=>$this->cart->id,
            'product_id'=>$product->id,
        ]);
        
        $cartItem->fill([
            'product_name'=>$product->name,
            'price'=>$product->price,
            'qty'=>$cartItem->qty+$qty,
        ]);

        $cartItem->save();
    }
}

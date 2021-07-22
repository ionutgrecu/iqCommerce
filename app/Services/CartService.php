<?php

namespace App\Services;

use App\Models\Cart;
use Auth;
use Session;

class CartService {

    private string $sessionId;
    private Cart|null $cart;

    public function __construct(string $sessionId = null) {
        $this->sessionId = $sessionId ?? Session::getId();

        $cart = Cart::where('session_id', $this->sessionId)->first();

        if (!$cart && Auth::user())
            $cart = Cart::where('user_id', Auth::user()->id)->first();

        if (!$cart) {
            $cart = new Cart;
            
        }
        
        $cart->fill([
                'user_id' => Auth::user() ? Auth::user()->id : null,
                'session_id' => $this->sessionId,
            ]);

        $cart->saveIfDirty();
    }

}

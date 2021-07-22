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

    function addToCart(Product $product, float $qty) {
        $cartItem = CartItem::firstOrNew([
                    'cart_id' => $this->cart->id,
                    'product_id' => $product->id,
        ]);

        $cartItem->fill([
            'product_name' => $product->name,
            'price' => $product->isDiscountEligible() ? $product->proposePrice() : $product->price,
            'qty' => $cartItem->qty + $qty,
        ]);

        $cartItem->save();
    }

    function removeFromCart(int $cartItemId) {
        CartItem::where('cart_id', $this->cart->id)->where('id', $cartItemId)->first()->delete();
    }

    function countItems(): int {
        return $this->cart->items()->count();
    }

    function getCart(): Cart {
        return $this->cart;
    }

    function getTotal(): float {
        return $this->cart->items->reduce(function ($carry, $item) {
                    $carry += $item->qty * $item->price;
                    return $carry;
                }) ?? 0;
    }

}

<?php
namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Repositories\Cart\CartRepo;

class CartRepoStore {

    public static function create(array $data) {

        $cart = Cart::create(
            [
                'user_id' => $data['user_id'] ?? null,
                'status' => $data['status'] ?? 'open',
                'currency' => $data['currency'] ?? null,
            ]
        );

        // Set meta
        $cart->setMeta('country_from_id', $data['country_from']->id);
        $cart->setMeta('country_from_code', $data['country_from']->code);
        $cart->setMeta('country_to_id', $data['country_to']->id);
        $cart->setMeta('country_to_code', $data['country_to']->code);

        // Add products to the cart
        CartProduct::create([
            'cart_id' => $cart->id,
            'order_id' => null,
            'product_id' => $data['product_id'],
            'offer_id' => null,
            'quantity' => $data['quantity'] ?? 1,
            'price' => 0,
            'total' => 0,
        ]);

        if( isset($cart) ) {
            return CartRepo::find( $cart->id );
        }

    }




}
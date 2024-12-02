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

    public static function updateMeta($cart_hash, array $data) {

        $cart = Cart::where('hash', $cart_hash)->first();

        if( isset($cart) ) {
            foreach( $data as $key => $value ) {
                
                // Check if key is in meta list
                if( 
                    in_array($key, self::listMeta()) &&
                    !empty($value)
                    ) {

                    if( $key == 'travellers' ) {
                        $value = self::prepareMultiple($value);
                    } 
                    
                    if( is_array( $value ) ) {
                        $value = json_encode($value);
                    }

                    $cart->setMeta($key, $value);
                }

            }
        }
        
    }    

    public static function prepareMultiple( $data ) {

        $res = [];
        foreach ($data as $key => $values) {
            foreach ($values as $index => $value) {
                $res[$index][$key] = $value;
            }
        }

        return $res;

    }

    public static function listMeta() {

        return [
            'country_from_id',
            'country_from_code',
            'country_to_id',
            'country_to_code',
            'time_arrival',
            'dest_airport_id',
            'full_name',
            'email',
            'phone',
            'travellers'
        ];

    }




}
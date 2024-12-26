<?php
namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Repositories\Cart\CartRepo;
use App\Repositories\FormFieldValue\FormFieldValueRepo;

class CartRepoStore {

    protected $fieldValueRepo;

    public function __construct() {
        $this->fieldValueRepo = new FormFieldValueRepo();
    }

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
        $cart->setMeta('travellers_count', 1);

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

    
    public static function update( $cart_id, $data ) {

        $cart = Cart::find( $cart_id );

        // Retrieve product
        $product = $cart->products[0];

        if( isset( $data['product']['quantity'] ) ) {

            // Update cart product
            $product->quantity = $data['product']['quantity'];
            $product->save();

        }

        // Calculate totals
        self::calcCartTotals( $cart_id );

    }

    public static function calcCartTotals( $cart_id ) {

        $cart = CartRepo::find( $cart_id );

        $cartProduct = CartProduct::find( $cart['products'][0]['id'] ); 
        $cartProduct->price = $cart['totals']['price'];
        $cartProduct->total = $cart['totals']['total_price'];
        $cartProduct->save();

        //dd($cart);
    }

    public static function updateMeta($cart_id, array $data) {

        $cart = Cart::find( $cart_id );

        if( isset($cart) ) {
            foreach( $data as $key => $value ) {
                
                // Check if key is in meta list
                if( 
                    in_array($key, self::listMeta()) &&
                    !empty($value)
                    ) {

                    if( $key == 'travellers' ) {
                        
                        $value = self::prepareMultiple($value);
                        $value = self::prepareTraveller($value, $cart->getMeta('travellers'));
                        //dd($value);
                        $cart->setMeta( 'travellers_count', count($value) );
                    } 
                    
                    if( is_array( $value ) ) {
                        $value = json_encode($value);
                    }

                    $cart->setMeta($key, $value);
                }

            }
        }
        
    }    

    public function updateFields($cart_id, array $fields) {

        $cart = Cart::find( $cart_id );

        if( isset($cart) ) {
            foreach( $fields as $field_id => $value ) {
                $this->fieldValueRepo->setCartValue( $cart_id, $field_id, $value );
            }
        }
        
    }

    public function getCartValues( $cart_id )
    {
        return $this->fieldValueRepo->getCartValues( $cart_id );
    }

    public function getTravellerValues( $cart_id )
    {
        return $this->fieldValueRepo->getTravellerValues( $cart_id );
    }

    public static function prepareTraveller($values, $old_values) {

        $old_values = json_decode( $old_values, true );

        // Iterate over the values array to update corresponding old values
        foreach ($values as $index => $new_data) {
            // Merge the old data with the new data for the corresponding index
            if (isset($old_values[$index])) {
                $old_values[$index] = array_merge($old_values[$index], $new_data);
            } else {
                // If the index doesn't exist in old_values, just add the new data
                $old_values[$index] = $new_data;
            }
        }
        
        //dd($old_values, $values);

        return $old_values;

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
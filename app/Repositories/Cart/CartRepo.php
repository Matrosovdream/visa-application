<?php
namespace App\Repositories\Cart;

use App\Models\Cart;

class CartRepo {

    public static function find( $id ) {
        return self::getCartBy($id, "id");
    }

    public static function getCartBy($value, $type = 'id') {

        $data = [];
        
        switch ($type) {
            case 'id':
                $model = self::getCartById($value);
                break;
            case 'hash':
                $model = self::getCartByHash($value);
                break;
            case 'session':
                $model = self::getCartBySession($value);
                break;
            case 'user':
                $model = self::getCartByUserId($value);
                break;
            case 'countries':
                $model = self::getCartByCountries($value);
                break;    
            default:
            $model = null;
                break;
        }

        // To array data if not null
        if ($model) {
            $data['fields'] = $model->toArray();
            $data['model'] = $model;
        }

        // Attach all meta data from ->meta 
        $data['meta'] = $model->getAllMeta();

        // Get products from cart
        $products = $model->products;
        foreach( $products as $product ) {
            $data['products'][] = array_merge( $product->toArray(), ['model' => $product] ); 
        }    

        return $data;

    }   

    public static function getCartById($cartId) {
        return Cart::find($cartId);
    }

    public static function getCartByUserId($userId) {
        return Cart::where('user_id', $userId)->first();
    }

    public static function getCartByHash($hash) {
        return Cart::where('hash', $hash)->first();
    }

    public static function getCartBySession($sessionId) {
        return Cart::where('session_id', $sessionId)->first();
    }

    public static function getCartByCountries($countries) {
        // Search in meta country by country_to_id and country_from_id
        return Cart::where('meta->country_to_id', $countries['country_to_id'])
                    ->where('meta->country_from_id', $countries['country_from_id'])
                    ->first();
    }



    

}
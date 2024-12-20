<?php
namespace App\Repositories\FormFieldValue;

use App\Models\CartFieldValue;
use App\Models\OrderFieldValue;
use App\Models\TravellerFieldValue;

class FormFieldValueRepo {

    public function getCartValues( $cart_id )
    {
        
        $data = CartFieldValue::where('cart_id', $cart_id)->get();
        dd($data);

    }

    public function setCartValue( $cart_id, $field_id, $value )
    {
        $data = CartFieldValue::where('cart_id', $cart_id)->where('field_id', $field_id)->first();
        if( $data ) {
            $data->value = $value;
            $data->save();
        } else {
            $data = new CartFieldValue();
            $data->cart_id = $cart_id;
            $data->field_id = $field_id;
            $data->value = $value;
            $data->save();
        }
    }

    public function getCartValue( $cart_id, $field_id )
    {
        $data = CartFieldValue::where('cart_id', $cart_id)->where('field_id', $field_id)->first();
        return $data;
    }

    public function getOrderValues( $order_id )
    {

        $data = OrderFieldValue::where('order_id', $order_id)->get();
        dd($data);

    }

    public function setOrderValue( $order_id, $field_id, $value )
    {
        $data = OrderFieldValue::where('order_id', $order_id)->where('field_id', $field_id)->first();
        if( $data ) {
            $data->value = $value;
            $data->save();
        } else {
            $data = new OrderFieldValue();
            $data->order_id = $order_id;
            $data->field_id = $field_id;
            $data->value = $value;
            $data->save();
        }
    }

    public function getOrderValue( $order_id, $field_id )
    {
        $data = OrderFieldValue::where('order_id', $order_id)->where('field_id', $field_id)->first();
        return $data;
    }

    public function getTravellerValues( $traveller_id )
    {
        $data = TravellerFieldValue::where('traveller_id', $traveller_id)->get();
        dd($data);
    }

    public function setTravellerValue( $traveller_id, $field_id, $value )
    {
        $data = TravellerFieldValue::where('traveller_id', $traveller_id)->where('field_id', $field_id)->first();
        if( $data ) {
            $data->value = $value;
            $data->save();
        } else {
            $data = new TravellerFieldValue();
            $data->traveller_id = $traveller_id;
            $data->field_id = $field_id;
            $data->value = $value;
            $data->save();
        }
    }

    public function getTravellerValue( $traveller_id, $field_id )
    {
        $data = TravellerFieldValue::where('traveller_id', $traveller_id)->where('field_id', $field_id)->first();
        return $data;
    }

}
<?php
namespace App\Repositories\FormFieldValue;

use App\Models\CartFieldValue;
use App\Models\OrderFieldValue;
use App\Models\TravellerFieldValue;

class FormFieldValueRepo {

    protected $cartModel;
    protected $orderModel;
    protected $travellerModel;

    protected $fields = [
        'cart_id',
        'field_id',
        'value',
    ];

    public function __construct()
    {
        $this->cartModel = new CartFieldValue();
        $this->orderModel = new OrderFieldValue();
        $this->travellerModel = new TravellerFieldValue();
    }

    public function getCartValues( $cart_id )
    {
        
        $values = $this->cartModel->where('cart_id', $cart_id)->get();
        foreach ($values as $key => $value) {
            $data[ $value->field_id ] = $this->prepareField( $value );
        }
        return $data;

    }

    public function setCartValue( $cart_id, $field_id, $value )
    {
        $data = $this->cartModel->where('cart_id', $cart_id)->where('field_id', $field_id)->first();
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
        $data = $this->cartModel->where('cart_id', $cart_id)->where('field_id', $field_id)->first();
        return $data;
    }

    public function getOrderValues( $order_id )
    {

        $data = $this->orderModel->where('order_id', $order_id)->get();
        dd($data);

    }

    public function setOrderValue( $order_id, $field_id, $value )
    {
        $data = $this->orderModel->where('order_id', $order_id)->where('field_id', $field_id)->first();
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
        $data = $this->orderModel->where('order_id', $order_id)->where('field_id', $field_id)->first();
        return $data;
    }

    public function getTravellerValues( $traveller_id )
    {
        $data = $this->travellerModel->where('traveller_id', $traveller_id)->get();
        return $data;
    }

    public function setTravellerValue( $traveller_id, $field_id, $value )
    {
        $data = $this->travellerModel->where('traveller_id', $traveller_id)->where('field_id', $field_id)->first();
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
        $data = $this->travellerModel->where('traveller_id', $traveller_id)->where('field_id', $field_id)->first();
        return $data;
    }

    public function prepareField( $field )
    {
        $data = [
            'id' => $field->id,
            'cart_id' => $field->cart_id,
            'field_id' => $field->field_id,
            'value' => $field->value,
        ];
        return $data;
    }


}
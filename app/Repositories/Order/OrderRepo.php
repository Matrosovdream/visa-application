<?php
namespace App\Repositories\Order;

use App\Repositories\AbstractRepo;
use App\Models\Order;
use App\Repositories\Order\OrderFieldValueRepo;

class OrderRepo extends AbstractRepo
{

    protected $model;
    protected $fields = [];
    protected $fieldValueRepo;
    protected $withRelations = ['user', 'meta', 'travellers', 'cartProducts'];

    public function __construct() {

        $this->model = new Order();

        $this->fieldValueRepo = new OrderFieldValueRepo();

    }

    /*
    public function getOrderValues( $cart_id )
    {
        return $this->fieldValueRepo->getOrderValues( $cart_id );
    }

    public function saveOrderValues( $order_id, $values )
    {
        foreach( $values as $field_id => $value ) {
            $this->fieldValueRepo->setOrderValue( $order_id, $field_id, $value );
        }
    }
    */

    public function mapItem($item)
    {

        if( empty($item) ) {
            return null;
        }

        $fieldValues = $this->fieldValueRepo->mapItems( $item->fieldValues );
        $fieldValues['Grouped'] = $this->fieldValueRepo->groupFields( $fieldValues['items'] );

        //dd($fieldValues);

        $res = [
            'id' => $item->id,
            'hash' => $item->hash,
            'user' => $item->user_id,
            'status' => $item->status_id,
            'payment_method' => $item->payment_method_id,
            'currency' => $item->currency,
            'is_paid' => $item->is_paid,
            'total_price' => $item->total_price,
            'fieldValues' => $fieldValues,
            'Model' => $item
        ];

        return $res;
    }

}
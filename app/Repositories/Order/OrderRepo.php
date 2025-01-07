<?php
namespace App\Repositories\Order;

use App\Repositories\FormFieldValue\FormFieldValueRepo;

class OrderRepo
{
    
    protected $fieldValueRepo;

    public function __construct() {
        $this->fieldValueRepo = new FormFieldValueRepo();
    }

    public function getOrderValues( $cart_id )
    {
        return $this->fieldValueRepo->getOrderValues( $cart_id );
    }

    

}
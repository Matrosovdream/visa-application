<?php
namespace App\Repositories\Traveller;

use App\Repositories\AbstractRepo;
use App\Models\Traveller;
use App\Repositories\Traveller\TravellerFieldValueRepo;
use App\Repositories\Order\OrderRepo;

class TravellerRepo extends AbstractRepo
{

    protected $model;
    protected $fields = [];
    protected $fieldValueRepo;
    protected $orderRepo;
    protected $withRelations = ['fieldValues', 'documents'];

    public function __construct() {

        $this->model = new Traveller();

        $this->fieldValueRepo = new TravellerFieldValueRepo();

    }

    public function getOrder( $traveller_id ) {

        // Set order repo and not break OrderRepo call from outside
        $this->orderRepo = new OrderRepo();

        $order = $this->orderRepo->mapItem( 
            $this->model->find($traveller_id)->orders->first()
        );

        return $order;

    } 

    public function mapItem($item)
    {

        if( empty($item) ) {
            return null;
        }

        // Field value from another table
        $fieldValues = $this->fieldValueRepo->mapItems( $item->fieldValues );

        $res = [
            'id' => $item->id,
            'fullname' => $item->full_name,
            'name' => $item->name,
            'lastname' => $item->lastname,
            'birthday' => $item->birthday,
            'passport' => $fieldValues['Grouped']['passport']['value'] ?? $item->passport,
            'fieldValues' => $fieldValues,
            'Model' => $item
        ];

        return $res;
    }

}
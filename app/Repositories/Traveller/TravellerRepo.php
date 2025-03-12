<?php
namespace App\Repositories\Traveller;

use App\Repositories\AbstractRepo;
use App\Models\Traveller;
use App\Repositories\Traveller\TravellerFieldValueRepo;

class TravellerRepo extends AbstractRepo
{

    protected $model;
    protected $fields = [];
    protected $fieldValueRepo;
    protected $withRelations = ['fieldValues', 'documents'];

    public function __construct() {

        $this->model = new Traveller();

        $this->fieldValueRepo = new TravellerFieldValueRepo();

    }

    public function mapItem($item)
    {

        if( empty($item) ) {
            return null;
        }

        $fieldValues = $this->fieldValueRepo->mapItems( $item->fieldValues );
        //$fieldValues['Grouped'] = $this->fieldValueRepo->groupFields( $fieldValues['items'] );

        //dd($fieldValues);

        $res = [
            'id' => $item->id,
            'fullname' => $item->full_name,
            'name' => $item->name,
            'lastname' => $item->lastname,
            'birthday' => $item->birthday,
            'passport' => $item->passport,
            'fieldValues' => $fieldValues,
            /*'hash' => $item->hash,
            'user' => $item->user_id,
            'status' => $item->status_id,
            'payment_method' => $item->payment_method_id,
            'currency' => $item->currency,
            'is_paid' => $item->is_paid,
            'total_price' => $item->total_price,
            'fieldValues' => $fieldValues,*/
            'Model' => $item
        ];

        return $res;
    }

}
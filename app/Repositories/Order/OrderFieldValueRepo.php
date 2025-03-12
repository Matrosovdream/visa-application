<?php
namespace App\Repositories\Order;

use App\Repositories\AbstractRepo;
use App\Models\OrderFieldValue;
use App\Repositories\FormField\FormFieldRepo;

class OrderFieldValueRepo extends AbstractRepo
{

    protected $model;
    protected $fields = [];
    protected $formFieldRepo;
    protected $withRelations = ['field'];

    public function __construct() {

        $this->model = new OrderFieldValue();

        $this->formFieldRepo = new FormFieldRepo();

    }

    public function mapItem($item)
    {

        if( empty($item) ) {
            return null;
        }

        $res = [
            'id' => $item->id,
            'field' => $this->formFieldRepo->mapItem($item->field),
            'value' => $item->value,
            'Model' => $item
        ];

        return $res;
    }

    public function groupFields( $fields ) {

        $grouped = [];

        foreach( $fields as $field ) {

            if( $field['field']['slug'] == 'arrival_date' ) {
                $grouped['arrival_date'] = $field;
            }

            if( $field['field']['is_fullname'] ) {
                $grouped['fullname'] = $field;
            }

            if( $field['field']['is_phone'] ) {
                $grouped['phone'] = $field;
            }

            if( $field['field']['is_email'] ) {
                $grouped['email'] = $field;
            }

        }

        return $grouped;

    }

}
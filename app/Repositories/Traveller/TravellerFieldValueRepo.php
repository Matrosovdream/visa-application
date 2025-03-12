<?php
namespace App\Repositories\Traveller;

use App\Repositories\AbstractRepo;
use App\Models\TravellerFieldValue;
use App\Repositories\FormField\FormFieldRepo;

class TravellerFieldValueRepo extends AbstractRepo
{

    protected $model;
    protected $fields = [];
    protected $formFieldRepo;
    protected $withRelations = ['field'];

    public function __construct() {

        $this->model = new TravellerFieldValue();

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

            if( $field['field']['is_name'] ) {
                $grouped['name'] = $field;
            }

            if( $field['field']['is_lastname'] ) {
                $grouped['lastname'] = $field;
            }

            if( $field['field']['is_birthday'] ) {
                $grouped['birthday'] = $field;
            }

            if( $field['field']['is_passport'] ) {
                $grouped['passport'] = $field;
            }

            if( $field['field']['is_passport'] ) {
                $grouped['passport'] = $field;
            }

        }

        return $grouped;

    }

    public function groupFieldsBySection( $fields ) {

        $grouped = [];

        foreach( $fields as $field ) {
            $grouped[ $field['field']['section'] ][] = $field;
        }

        return $grouped;

    }



}
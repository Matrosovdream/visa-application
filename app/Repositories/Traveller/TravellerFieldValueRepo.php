<?php
namespace App\Repositories\Traveller;

use App\Repositories\AbstractRepo;
use App\Models\TravellerFieldValue;
use App\Repositories\FormField\FormFieldRepo;
use App\Repositories\Country\CountryRepo;

class TravellerFieldValueRepo extends AbstractRepo
{

    protected $model;
    protected $fields = [];
    protected $formFieldRepo;
    protected $countryRepo;
    protected $withRelations = ['field'];

    public function __construct() {

        $this->model = new TravellerFieldValue();

        // References
        $this->formFieldRepo = new FormFieldRepo();
        $this->countryRepo = new CountryRepo();

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

    public function mapItems($items)
    {

        $res = [];

        foreach( $items as $item ) {
            $mappedItem = $this->mapItem($item);
            $res[ $mappedItem['field']['id'] ] = $mappedItem;
        }

        return [
            'items' => $res,
            'Grouped' => $this->groupFields( $res ),
            'GroupedBySection' => $this->groupFieldsBySection( $res ),
        ];

    }

    public function mapItem($item)
    {

        if( empty($item) ) {
            return null;
        }

        $field = $this->formFieldRepo->mapItem($item->field);

        if( $field['type'] == 'reference' ) {

            switch( $field['reference_code'] ) {
                case 'country':
                    $item->valueReference = $this->countryRepo->getById( $item->value );
                    break;
            }

        }

        $res = [
            'id' => $item->id,
            'field' => $field,
            'value' => $item->value,
            'valueReference' => $item->valueReference,
            'Model' => $item
        ];

        return $res;
    }

}
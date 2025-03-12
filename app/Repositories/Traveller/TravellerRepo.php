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
        $fieldValues['Grouped'] = $this->fieldValueRepo->groupFields( $fieldValues['items'] );
        $fieldValues['GroupedBySection'] = $this->fieldValueRepo->groupFieldsBySection( $fieldValues['items'] );

        //dd($fieldValues);

        $res = [
            'id' => $item->id,
            'fullname' => $item->full_name,
            'name' => $item->name,
            'lastname' => $item->lastname,
            'birthday' => $item->birthday,
            'passport' => $item->passport,
            'fieldValues' => $fieldValues,
            'Model' => $item
        ];

        return $res;
    }

}
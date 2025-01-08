<?php
namespace App\Repositories\Traveller;

use App\Repositories\FormFieldValue\FormFieldValueRepo;

class TravellerRepoStore
{
    
    protected $fieldValueRepo;

    public function __construct() {
        $this->fieldValueRepo = new FormFieldValueRepo();
    }

    public function getTravellerValues( $traveller_id )
    {
        return $this->fieldValueRepo->getTravellerValues( $traveller_id );
    }

    public function saveFieldValues( $traveller_id, $values )
    {
        foreach( $values as $field_id => $value ) {
            if( is_array( $value )) { 
                $value = $value[0]; 
            }
            $this->fieldValueRepo->setTravellerValue( $traveller_id, $field_id, $value );
        }
    }

}
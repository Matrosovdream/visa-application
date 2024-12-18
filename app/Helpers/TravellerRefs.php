<?php
namespace App\Helpers;

use App\References\TravellerReferences;

class TravellerRefs
{

    public static function travellerFields()
    {
        return TravellerReferences::travellerFields();
    }

    public static function Genders()
    {
        return TravellerReferences::Genders();
    }

    public static function MaritalStatuses()
    {
        return TravellerReferences::maritalStatuses();
    }

}
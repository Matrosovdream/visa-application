<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReferenceFormField;
use App\References\ProductReferences;
use App\References\TravellerReferences;

class ReferenceFormFieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $fieldsOrder = ProductReferences::userFields();
        $fieldTraveller = TravellerReferences::userFields();
        $fields = array_merge($fieldsOrder, $fieldTraveller);
        
        foreach ($fields as $field) {

            ReferenceFormField::firstOrCreate(
                ['slug' => $field['slug'], 'entity' => $field['entity']
            ], $field);
        }

    }
}

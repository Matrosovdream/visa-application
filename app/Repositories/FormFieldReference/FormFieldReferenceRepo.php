<?php
namespace App\Repositories\FormFieldReference;

use App\Models\ReferenceFormField;
use App\Models\ProductFieldReference;
use App\Models\Country;
use App\Models\Airport;
use App\Helpers\TravellerHelper;


class FormFieldReferenceRepo
{

    public function getInitialFields($filters = [])
    {

        $query = ReferenceFormField::orderBy('id', 'asc');
        if (count($filters) > 0) {

            foreach ($filters as $key => $value) {
                $query->where($key, $value);
            }

        }

        $fields = $query->get();

        // Prepare the fields
        $data = [];
        foreach ($fields as $field) {
            $data[] = $this->prepareInitialField( $field );
        }

        return $data;

    }

    public function getById($id)
    {

        $data = ReferenceFormField::find($id);

        $fields = $this->prepareInitialField( $data );

        if ($data->reference_code) {
            $fields['options'] = $this->getRefererenceOptions($data->reference_code);
        }

        return $fields;

    }

    public function getProductFields($product_id, $filters = [])
    {

        $query = ProductFieldReference::orderBy('id', 'asc');

        // Filter by product_id
        $query->where('product_id', $product_id);

        // Apply additional filters
        if (count($filters) > 0) {

            foreach ($filters as $key => $value) {
                $query->where($key, $value);
            }

        }

        // Get the results
        $fields = $query->get();

        // Prepare the fields
        $data = [];
        foreach ($fields as $field) {
            $data[] = [
                "id" => $field->id,
                "entity" => $field->entity,
                "section" => $field->section,
                "required" => $field->required,
                "default_value" => $field->default_value,
                "field" => $this->getById($field->field_id)
            ];
        }

        return $data;

    }

    public function getRefererenceOptions($reference_code)
    {

        switch ($reference_code) {
            case 'country':
                $options = Country::all()->toArray();
                break;
            case 'airport':
                $options = Airport::all();
                break;
            case 'gender':
                $options = TravellerHelper::getReference('gender');
                break;
            case 'boolean':
                $options = TravellerHelper::getReference('boolean');
                break;
            case 'marital_status':
                $options = TravellerHelper::getReference('marital_status');
                break;
            default:
                $options = [];
        }

        return $options;

    }

    private function prepareInitialField($field)
    {

        return [
            "id" => $field->id,
            "title" => $field->title,
            "slug" => $field->slug,
            "entity" => $field->entity,
            "type" => $field->type,
            "section" => $field->section,
            "placeholder" => $field->placeholder,
            "tooltip" => $field->tooltip,
            "description" => $field->description,
            "default_value" => $field->default_value,
            "reference_code" => $field->reference_code,
            "default" => $field->default
        ];

    }

}
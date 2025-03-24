<?php
namespace App\Repositories\Product;

use App\Models\ProductFieldReference;
use App\Repositories\FormFieldReference\FormFieldReferenceRepo;

class ProductFieldsReferenceRepo {

    protected $model;

    protected $formFieldRepo;

    protected $fields = [
        'field_id',
        'product_id',
        'entity',
        'section',
        'placeholder',
        'classes',
        'required',
        'default_value',
    ];

    public function __construct()
    {
        $this->model = new ProductFieldReference();
        $this->formFieldRepo = new FormFieldReferenceRepo();
    }

    public function getFieldsByProduct($product_id, $filter=[])
    {
        $fields = $this->model->where('product_id', $product_id);

        if (count($filter) > 0) {
            foreach ($filter as $key => $value) {
                $fields->where($key, $value);
            }
        }
        $fields = $fields->get();

        $items = $this->mapItems($fields);

        return $this->groupFields($items);
        
    }

    public function getById($id)
    {
        $field = $this->model->find($id);
        return $this->mapItem($field);
    }

    public function getOrderFieldsByProduct($product_id)
    {
        return $this->getFieldsByProduct($product_id, ['entity' => 'order']);
    }

    public function getTravellerFieldsByProduct($product_id)
    {
        return $this->getFieldsByProduct($product_id, ['entity' => 'traveller']);
    }

    public function create($data)
    {

        // Prepare the values
        $values = $this->prepareValues($data);

        // Create the field and return it
        return $this->model->create($values );

    }

    public function update($id, $data)
    {

        // Fine the field
        $field = $this->model->find($id);

        // Prepare the values
        $values = $this->prepareValues($data);

        // Update the field
        $field->update($values);

        return $field;

    }

    public function deleteById($id)
    {

        $field = $this->model->find($id);
        $field->delete();

    }

    private function prepareValues($data)
    {

        $values = [];
        foreach ($this->fields as $field_code) {
            $values[ $field_code ] = $data[ $field_code ] ?? null;
        }

        return $values;

    }

    public function groupFields($fields)
    {

        // Group by entity = order
        $order = [];
        $traveller = [];

        foreach ($fields as $field) {
            $field_id = $field['field']['id'];

            switch ($field['entity']) {
                case 'order':
                    $order[ $field_id ] = $field;
                    break;
                case 'traveller':
                    $traveller[ $field_id ] = $field;
                    break;
            }
        }

        $grouped = [
            'all' => $fields,
            'order' => $this->subGroupFields($order),
            'traveller' => $this->subGroupFields($traveller),
        ];
    
        return $grouped;
    }

    protected function subGroupFields( $fields ) {

        return  [
            'all' => $fields,
            'required' => $this->filterArrayBy($fields, 'required', 1),
            'optional' => $this->filterArrayBy($fields, 'required', 0),
        ];

    }

    protected function filterArrayBy( $array, $field, $value )
    {
        return array_filter($array, function($item) use ($field, $value) {
            return $item[$field] == $value;
        });

    }

    public function mapItems($items)
    {
        $mapped = [];
        foreach ($items as $item) {
            $mappedItem = $this->mapItem($item);
            $mapped[ $mappedItem['field']['id'] ] = $mappedItem;
        }

        return $mapped;
    }

    public function mapItem($item)
    {
        return [
            'id' => $item->id,
            'field' => $this->formFieldRepo->getById($item->field_id),
            'product_id' => $item->product_id,
            'entity' => $item->entity,
            'section' => $item->section,
            'placeholder' => $item->placeholder,
            'classes' => $item->classes,
            'required' => $item->required,
            'default_value' => $item->default_value,
        ];
    }


}
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

        $items = [];
        foreach ($fields as $field) {
            $items[] = $this->mapItem($field);
        }
        
        return $items;
        
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

    public function mapItem($item)
    {
        return [
            'id' => $item->id,
            'field' => $this->formFieldRepo->getById($item->field_id),
            'product_id' => $item->product_id,
            'entity' => $item->entity,
            'section' => $item->section,
            'required' => $item->required,
            'default_value' => $item->default_value,
        ];
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




}
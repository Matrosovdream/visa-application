<?php
namespace App\Repositories\FormField;

use App\Repositories\AbstractRepo;
use App\Models\ReferenceFormField;

class FormFieldRepo extends AbstractRepo
{

    protected $model;
    protected $fields = [];
    protected $formFieldRepo;
    protected $withRelations = ['field'];

    public function __construct() {

        $this->model = new ReferenceFormField();

    }

    public function mapItem($item)
    {

        if( empty($item) ) {
            return null;
        }

        $res = [
            'id' => $item->id,
            'title' => $item->title,
            'slug' => $item->slug,
            'entity' => $item->entity,
            'type' => $item->type,
            'section' => $item->section,
            'placeholder' => $item->placeholder,
            'tooltip' => $item->tooltip,
            'description' => $item->description,
            'default_value' => $item->default_value,
            'reference_code' => $item->reference_code,
            'icon' => $item->icon,
            'default' => $item->default,
            'is_email' => $item->is_email,
            'is_phone' => $item->is_phone,
            'is_fullname' => $item->is_fullname,
            'is_name' => $item->is_name,
            'is_lastname' => $item->is_lastname,
            'is_birthday' => $item->is_birthday,
            'is_passport' => $item->is_passport,
            'classes' => $item->classes,
            'Model' => $item
        ];

        return $res;
    }

}
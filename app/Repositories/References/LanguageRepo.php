<?php
namespace App\Repositories\References;

use App\Repositories\AbstractRepo;
use App\Models\Language;

class LanguageRepo extends AbstractRepo
{

    protected $model;
    protected $fields = [];
    protected $withRelations = [];

    public function __construct() {

        $this->model = new Language();
    }

    public function mapItems($items)
    {
        $res = [];
        foreach($items as $item) {
            $res[ $item['code'] ] = $this->mapItem($item);
        }

        return $res;
    }

    public function mapItem($item)
    {

        if( empty($item) ) {
            return null;
        }

        $res = [
            'id' => $item->id,
            'name' => $item->name,
            'code' => $item->code,
            'is_default' => $item->is_default,
            'is_active' => $item->is_active,
            'Model' => $item
        ];

        return $res;
    }

}
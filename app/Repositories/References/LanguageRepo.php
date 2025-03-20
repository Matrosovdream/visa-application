<?php
namespace App\Repositories\Article;

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
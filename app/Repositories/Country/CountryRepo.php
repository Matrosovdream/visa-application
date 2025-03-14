<?php
namespace App\Repositories\Country;

use App\Repositories\AbstractRepo;
use App\Models\Country;


class CountryRepo extends AbstractRepo
{

    protected $model;

    protected $fields = [];

    public function __construct()
    {
        $this->model = new Country();
    }

    public function mapItem($item)
    {
        if (!$item) return null;

        $res = [
            'id' => $item->id,
            'title' => $item->name,
            'slug' => $item->slug,
            'code' => $item->code,
            'icon' => $item->icon,
            'description' => $item->description,
            'Model' => $item
        ];
        return $res;
    }

}
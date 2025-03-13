<?php
namespace App\Repositories\User;

use App\Repositories\AbstractRepo;
use App\Models\User;

class UserRepo extends AbstractRepo
{

    protected $model;
    protected $fields = [];
    protected $withRelations = [];

    public function __construct() {

        $this->model = new User();

    }

    public function mapItem($item)
    {

        if( empty($item) ) {
            return null;
        }

        $res = [
            'id' => $item->id,
            'name' => $item->name,
            'email' => $item->email,
            'is_active' => $item->is_active,
            'Model' => $item
        ];

        return $res;
    }

}
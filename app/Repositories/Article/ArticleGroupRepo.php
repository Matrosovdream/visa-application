<?php
namespace App\Repositories\Article;

use App\Repositories\AbstractRepo;
use App\Models\ArticleGroup;

class ArticleGroupRepo extends AbstractRepo
{

    protected $model;
    protected $fields = [];
    protected $userRepo;
    protected $withRelations = [];

    public function __construct() {

        $this->model = new ArticleGroup();

    }

    public function mapItem($item)
    {

        if( empty($item) ) {
            return null;
        }

        $res = [
            'id' => $item->id,
            'name' => $item->name,
            'slug' => $item->slug,
            'Model' => $item
        ];

        return $res;
    }

}
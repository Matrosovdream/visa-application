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
    protected $translatableFields = ['name'];

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
            'description' => $item->description,
            'is_active' => $item->is_active,
            'isTranslated' => $this->isTranslated( $item ),
            'articleCount' => $item->articles_count,
            'Model' => $item
        ];

        return $res;
    }

}
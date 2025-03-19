<?php
namespace App\Repositories\Article;

use App\Repositories\AbstractRepo;
use App\Models\ArticleGroupLink;

class ArticleGroupLinkRepo extends AbstractRepo
{

    protected $model;
    protected $fields = [];
    protected $userRepo;
    protected $withRelations = [];

    public function __construct() {

        $this->model = new ArticleGroupLink();

    }

    public function mapItem($item)
    {

        if( empty($item) ) {
            return null;
        }

        $res = [
            'id' => $item->id,
            'article_id' => $item->article_id,
            'article_group_id' => $item->article_group_id,
            'Model' => $item
        ];

        return $res;
    }

}
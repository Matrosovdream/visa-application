<?php
namespace App\Repositories\Article;

use App\Repositories\AbstractRepo;
use App\Repositories\User\UserRepo;
use App\Models\Article;


class ArticleRepo extends AbstractRepo
{

    protected $model;
    protected $fields = [];
    protected $userRepo;
    protected $articleGroupRepo;
    protected $withRelations = ['groups'];

    public function __construct() {

        $this->model = new Article();

        $this->userRepo = new UserRepo();

        $this->articleGroupRepo = new ArticleGroupRepo();

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
            'short_description' => $item->short_description,
            'content' => $item->content,
            'author' => $this->userRepo->mapItem( $item->author ),
            'groups' => $this->articleGroupRepo->mapItems( $item->groups ),
            'published' => $item->published,
            'Model' => $item
        ];

        return $res;
    }

}
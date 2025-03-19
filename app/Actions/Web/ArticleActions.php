<?php
namespace App\Actions\Web;

use App\Repositories\Article\ArticleRepo;
use App\Repositories\Article\ArticleGroupRepo;



class ArticleActions {

    protected $articleRepo;
    protected $articleGroupRepo;

    public function __construct() {

        $this->articleRepo = new ArticleRepo();
        $this->articleGroupRepo = new ArticleGroupRepo();

    }

    public function index($request) {

        $groups = $this->articleGroupRepo->getAll(['is_active' => 1], $paginate = 1000);

        //dd($groups);

        return [
            'title' => 'All articles',
            'groups' => $groups
        ];

    }

    public function show($article_slug) {

        $article = $this->articleRepo->getBySlug($article_slug);

        return [
            'title' => $article['title'],
            'article' => $article
        ];
    }

}
<?php
namespace App\Actions\Web;

use App\Repositories\Article\ArticleRepo;



class ArticleActions {

    protected $articleRepo;

    public function __construct() {

        $this->articleRepo = new ArticleRepo();

    }

    public function index($request) {

        $articles = $this->articleRepo->getAll([], $paginate=1000);

        return [
            'title' => 'Articles',
            'articles' => $articles
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
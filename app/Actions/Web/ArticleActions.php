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
            'title' => ' All categories',
            'groupTitle' => 'Travel',
            'groups' => $groups
        ];

    }

    public function group($request, $group_slug) {

        $group = $this->articleGroupRepo->getBySlug($group_slug);
        $articles = $this->articleRepo->getAll([], $paginate = 10);
//dd($articles);
        return [
            'title' => 'Articles by category',
            'group' => $group,
            'groupTitle' => $group['name'],
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
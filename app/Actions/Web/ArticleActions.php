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

        // Exclude groups with empty and untranslated groups
        $groups['items'] = collect($groups['items'])->filter(function($group) {
            return $group['articleCount'] > 0 && $group['isTranslated'];
        });

        return [
            'title' => __('All categories'),
            'groupTitle' => __('Travel'),
            'groups' => $groups
        ];

    }

    public function group($request, $group_slug) {

        $group = $this->articleGroupRepo->getBySlug($group_slug);
        $articles = $this->articleRepo->getAllByGroup( 
            $group['id'], 
            $filters = ['published' => 1],
            $paginate = 1000
        );

        // Exclude untranslated articles
        $articles['items'] = collect($articles['items'])->filter(function($article) {
            return $article['isTranslated'];
        });

        return [
            'title' => __('Articles by category'),
            'group' => $group,
            'groupTitle' => $group['name'],
            'articles' => $articles
        ];

    }

    public function show($group_slug, $article_slug) {

        $group = $this->articleGroupRepo->getBySlug($group_slug);
        $article = $this->articleRepo->getBySlug($article_slug);

        return [
            'title' => $article['title'],
            'article' => $article
        ];
    }

}
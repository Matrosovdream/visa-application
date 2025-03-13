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

        dd($articles);

    }

}
<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Web\ArticleActions;


class ArticleController extends Controller
{

    protected $articleActions;

    public function __construct()
    {
        $this->articleActions = new ArticleActions();
    }
    
    public function index( Request $request )
    {
        return view(
                'web.articles.index', 
                $this->articleActions->index($request)
            );
    }

    public function show($article_slug)
    {
        return view(
                'web.articles.show', 
                $this->articleActions->show($article_slug)
            );
    }

}

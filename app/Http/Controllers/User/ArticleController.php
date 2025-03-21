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

    public function group( Request $request, $group_slug )
    {
        return view(
                'web.articles.group', 
                $this->articleActions->group($request, $group_slug)
            );
    }

    public function show($group_slug, $article_slug)
    {
        return view(
                'web.articles.show', 
                $this->articleActions->show($group_slug, $article_slug)
            );
    }

}

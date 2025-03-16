<?php
namespace App\Actions\Dashboard;

use App\Helpers\adminSettingsHelper;
use App\Models\Article;
use App\Repositories\Article\ArticleRepo;

class ArticleActions
{

    protected $articleRepo;

    public $perPage = 10;

    public function __construct( ArticleRepo $articleRepo )
    {
        $this->articleRepo = $articleRepo;
    }

    public function index( $request )
    {
        if( request('s') ) {
            $items = Article::search(request('s'))->paginate($this->perPage);
        } else {
            $items = Article::paginate($this->perPage);
        }

        $data = [
            'title' => 'Articles',
            'articles' => $items,
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];
        return $data;

    }

    public function show( $id )
    {

        $article = Article::find($id);

        $data = [
            'title' => 'Edit '.$article->title,
            'article' => $article,
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];
        return $data;
    }

    public function create()
    {
        $data = [
            'title' => 'Create Article',
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];
        return $data;
    }

    public function store( $request )
    {

        $article = new Article();
        $article->title = $request->title;
        $article->content = $request->content;
        $article->save();

        return $article;

    }

    public function edit( $id )
    {
        $article = Article::find($id);

        $data = [
            'title' => 'Edit '.$article->title,
            'article' => $article,
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        return $data;
    }

    public function update( $request, $id )
    {
        $article = Article::find($id);
        $article->title = $request->title;
        $article->content = $request->content;
        $article->save();

        return $article;
    }
 
    public function destroy( $id )
    {
        $article = Article::find($id);
        $article->delete();
    }


}
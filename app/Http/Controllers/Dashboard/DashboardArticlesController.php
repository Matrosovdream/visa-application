<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Helpers\adminSettingsHelper;
use App\Actions\Dashboard\ArticleActions;
use Illuminate\Http\Request;

class DashboardArticlesController extends Controller
{

    protected $articleActions;

    public function __construct( ArticleActions $articleActions )
    {
        $this->articleActions = $articleActions;
    }
    
    public function index( Request $request )
    {
        return view(
            'dashboard.articles.index', 
            $this->articleActions->index( $request )
        );
    }

    public function show($id)
    {
        $article = Article::find($id);

        $data = [
            'title' => 'Edit '.$article->title,
            'article' => $article,
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        return view('dashboard.articles.show', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Create Article',
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        return view('dashboard.articles.create', $data);
    }

    public function store()
    {
        $article = new Article();
        $article->title = request('title');
        $article->content = request('content');
        $article->save();

        return redirect()->route('dashboard.articles.index');
    }

    public function edit($id)
    {
        $article = Article::find($id);

        $data = [
            'title' => 'Edit '.$article->title,
            'article' => $article,
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        return view('dashboard.articles.edit', $data);
    }

    public function update($id)
    {
        $article = Article::find($id);
        $article->title = request('title');
        $article->content = request('content');
        $article->save();

        return redirect()->route('dashboard.articles.index');
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();

        return redirect()->route('dashboard.articles.index');
    }

}

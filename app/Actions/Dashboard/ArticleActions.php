<?php
namespace App\Actions\Dashboard;

use App\Helpers\adminSettingsHelper;
use App\Models\Article;
use App\Repositories\Article\ArticleRepo;
use App\Models\ArticleGroup;

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
            $items = Article::with('groups')->paginate($this->perPage);
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

        // Prepare article groups for the view
        $articleGroups = [];
        foreach( $article['groups'] as $group ) {
            $articleGroups[$group->id] = $group->name;
        }

        $data = [
            'title' => 'Edit '.$article->title,
            'article' => $article,
            'articleGroups' => $articleGroups,
            'groups' => ArticleGroup::all(),
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        return $data;
    }

    public function create()
    {
        $data = [
            'title' => 'Create Article',
            'groups' => ArticleGroup::all(),
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
        $article->published = $request->published ? 1 : 0;
        $article->slug = $request->slug;
        $article->short_description = $request->short_description;
        $article->summary = $request->summary;
        $article->content = $request->content;
        $article->save();

        // Remove all groups
        $article->groupLinks()->get()->each->delete();

        // Update groups
        foreach( $request->groups as $group ) {
            // Create new group link
            $article->groupLinks()->create([
                'article_group_id' => $group,
            ]);

        }

        return $article;
    }
 
    public function destroy( $id )
    {
        $article = Article::find($id);
        $article->delete();
    }


}
<?php
namespace App\Actions\Dashboard;

use App\Helpers\adminSettingsHelper;
use App\Models\Article;
use App\Repositories\Article\ArticleRepo;
use App\Models\ArticleGroup;
use App\Repositories\References\LanguageRepo;
use App\Traits\Languable;

class ArticleActions
{

    use Languable;

    protected $articleRepo;

    public $perPage = 30;

    public function __construct( ArticleRepo $articleRepo )
    {
        $this->articleRepo = $articleRepo;

        // References
        $this->languageRepo = new LanguageRepo();

        // Set language globally
        $this->setLang();
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
            'languages' => $this->languageRepo->getAll(['is_active' => 1]),
            'activeLang' => $this->activeLang,
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

        // Create article
        $article = new Article;
        $article->title = $request->title;
        $article->published = $request->published ? 1 : 0;
        $article->slug = $request->slug;
        $article->short_description = $request->short_description;
        $article->summary = $request->summary;
        $article->content = $request->content;
        $article->author_id = auth()->user()->id;
        $article->save();

        // Update groups
        foreach( $request->groups as $group ) {
            // Create new group link
            $article->groupLinks()->create([
                'article_group_id' => $group,
            ]);

        }


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

        // Set langage translation if exists
        $this->setLang( $request['lang'] );

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
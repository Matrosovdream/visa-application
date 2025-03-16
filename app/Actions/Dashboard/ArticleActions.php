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

        $data = [
            'title' => 'Edit Field #'.$id,
            'field' => $this->articleRepo->getById($id),
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
            'references' => $this->articleRepo->getReferences(),
            'entities' => $this->articleRepo->getEntities(),
            'field_types' => $this->articleRepo->getFieldTypes(),
        ];
        //dd($data);

        return $data;
    }

    public function create()
    {
        $data = [
            'title' => 'Create Field',
            'entity' => 'traveller',
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
            'references' => $this->articleRepo->getReferences(),
            'entities' => $this->articleRepo->getEntities(),
            'field_types' => $this->articleRepo->getFieldTypes(),
        ];

        //dd($data);

        return $data;
    }

    public function store( $request )
    {

        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'entity' => 'required',
            'type' => 'required'
        ]);
        
        $data = $request->all();
        return $this->articleRepo->create($data);

    }

    public function update($id, $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'entity' => 'required',
            'type' => 'required'
        ]);

        $data = $request->all();
        return $this->articleRepo->update($id, $data);
    }
 
    public function destroy($id)
    {
        $this->articleRepo->deleteById($id);
    }


}
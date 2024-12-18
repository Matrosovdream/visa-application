<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Helpers\adminSettingsHelper;

class DashboardTravellerFieldsController extends Controller
{

    public $perPage = 10;
    
    public function index()
    {

        $data = [
            'title' => 'Articles',
            'articles' => [],
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        return view('dashboard.travellerfields.index', $data);
    }

    public function show($id)
    {

        $data = [
            'title' => 'Edit ',
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        return view('dashboard.travellerfields.show', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Create Article',
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        return view('dashboard.travellerfields.create', $data);
    }

    public function store()
    {
        $article = new Article();
        $article->title = request('title');
        $article->content = request('content');
        $article->save();

        return redirect()->route('dashboard.travellerfields.index');
    }

    public function edit($id)
    {
        $article = Article::find($id);

        $data = [
            'title' => 'Edit '.$article->title,
            'article' => $article,
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        return view('dashboard.travellerfields.edit', $data);
    }

    public function update($id)
    {
        

        return redirect()->route('dashboard.travellerfields.index');
    }

    public function destroy($id)
    {
        
        return redirect()->route('dashboard.aorderfields.index');
    }

}

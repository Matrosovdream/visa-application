<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Helpers\adminSettingsHelper;

class DashboardOrderFieldsController extends Controller
{

    public $perPage = 10;
    
    public function index()
    {

        $data = [
            'title' => 'Articles',
            'articles' => [],
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        return view('dashboard.orderfields.index', $data);
    }

    public function show($id)
    {

        $data = [
            'title' => 'Edit ',
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        return view('dashboard.orderfields.show', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Create Article',
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        return view('dashboard.orderfields.create', $data);
    }

    public function store()
    {
        $article = new Article();
        $article->title = request('title');
        $article->content = request('content');
        $article->save();

        return redirect()->route('dashboard.orderfields.index');
    }

    public function edit($id)
    {
        $article = Article::find($id);

        $data = [
            'title' => 'Edit '.$article->title,
            'article' => $article,
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        return view('dashboard.orderfields.edit', $data);
    }

    public function update($id)
    {
        

        return redirect()->route('dashboard.orderfields.index');
    }

    public function destroy($id)
    {
        
        return redirect()->route('dashboard.aorderfields.index');
    }

}

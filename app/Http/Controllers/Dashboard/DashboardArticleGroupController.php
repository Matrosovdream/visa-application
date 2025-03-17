<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Actions\Dashboard\ArticleGroupActions;
use Illuminate\Http\Request;

class DashboardArticleGroupController extends Controller
{

    private $articleGroupActions;

    public function __construct()
    {
        $this->articleGroupActions = new ArticleGroupActions;
    }


    public function index()
    {
        return view(
            'dashboard.articlegroups.index', 
            $this->articleGroupActions->index()
        );
    }

    public function show( $driver_id )
    {
        return view(
            'dashboard.articlegroups.show', 
            $this->articleGroupActions->show($driver_id)
        );
    }

    public function update($driver_id, Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'nullable',
            'is_active' => 'nullable'
        ]);

        $data = $this->articleGroupActions->update($driver_id, $validated);
        return redirect()->back();
    }

    public function create()
    {
        return view(
            'dashboard.articlegroups.create', 
            $this->articleGroupActions->create()
        );
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'nullable',
            'is_active' => 'nullable'
        ]);

        $data = $this->articleGroupActions->store($validated);
        return redirect()->route('dashboard.articlegroups.index');
    }

    public function destroy($service)
    {
        $data = $this->articleGroupActions->destroy($service);
        return redirect()->route('dashboard.articlegroups.index');
    }
}

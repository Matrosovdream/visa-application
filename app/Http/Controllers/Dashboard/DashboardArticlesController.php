<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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
        return view(
            'dashboard.articles.show', 
            $this->articleActions->show( $id )
        );
    }

    public function create()
    {
        return view(
            'dashboard.articles.create', 
            $this->articleActions->create()
            );
    }

    public function store( Request $request )
    {
        $this->articleActions->store( $request );
        return redirect()->route('dashboard.articles.index');
    }

    public function edit($id)
    {
        return view(
            'dashboard.articles.edit', 
            $this->articleActions->show( $id )
        );
    }

    public function update(Request $request, $id)
    {
        $this->articleActions->update( $request, $id );
        return redirect()->route('dashboard.articles.index');
    }

    public function destroy($id)
    {
        $this->articleActions->destroy( $id );
        return redirect()->route('dashboard.articles.index');
    }

}

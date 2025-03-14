<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Web\IndexActions;


class IndexController extends Controller {

    protected $indexActions;

    public function __construct( IndexActions $indexActions ) {

        $this->indexActions = $indexActions;

    }   

    public function index( Request $request )
    {
        return view(
                    'web.index',
                    $this->indexActions->index( $request )
        );
    }

    public function directionApply( Request $request )
    {
        return redirect()->route(
            'web.country.index', 
            $this->indexActions->directionApply( $request )
        );
    }

}

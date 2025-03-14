<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Country;
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

        $country_from = Country::find($request->country_from);
        $country_to = Country::find($request->country_to);

        return redirect()->route('web.country.index', 
            [
            'country' => $country_to->slug, 
            'nationality' => $country_from->slug
            ]
        );

    }

}

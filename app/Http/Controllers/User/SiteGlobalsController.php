<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Web\SiteGlobalsActions;

class SiteGlobalsController extends Controller
{

    protected $siteGlobalsActions;

    public function __construct( SiteGlobalsActions $siteGlobalsActions ) {

        $this->siteGlobalsActions = $siteGlobalsActions;

    }
    
    public function setLanguage( Request $request )
    {
        $this->siteGlobalsActions->setLanguage( $request );
        return redirect()->back();
    }

    public function setCurrency( Request $request )
    {
        $this->siteGlobalsActions->setCurrency( $request );
        return redirect()->back();
    }


}
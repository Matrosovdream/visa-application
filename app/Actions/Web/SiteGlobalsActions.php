<?php
namespace App\Actions\Web;

use App\Services\GlobalsService;


class SiteGlobalsActions {

    protected $globalsService;

    public function __construct( GlobalsService $globalsService ) {

        $this->globalsService = $globalsService;

    }

    public function setLanguage( $request )
    {
        $this->globalsService->setLanguage( $request->input('lang') );
    }

    public function setCurrency( $request )
    {
        $this->globalsService->setCurrency( $request->input('currency') );
    }


}
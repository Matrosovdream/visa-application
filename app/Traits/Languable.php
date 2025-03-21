<?php
namespace App\Traits;

use Illuminate\Support\Facades\App;

trait Languable {

    public $languageRepo;
    public $activeLang;

    public function setLang( $lang=false )
    {

        if( $lang ) {
            $activeLang = $lang;
        } else {
            $activeLang = isset($_GET['lang']) ? $_GET['lang'] : 'en';
        }
        $activeLang = strtolower($activeLang);

        $this->activeLang = $activeLang;

        App::setLocale( $activeLang );
    }

}
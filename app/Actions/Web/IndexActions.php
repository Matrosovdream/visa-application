<?php
namespace App\Actions\Web;

use App\Services\LocationService;
use App\Models\Article;
use App\Models\Country;


class IndexActions {

    public function index( $request ) {

        return array(
            'title' => 'Homepage',
            'articles' => Article::paginate(3),
            'location' => LocationService::getLocation( $request->ip() )
        );

    }

    public function directionApply( $request ) {

        $country_from = Country::find($request->country_from);
        $country_to = Country::find($request->country_to);

        return [
            'country' => $country_to->slug, 
            'nationality' => $country_from->slug
        ];

    }

}
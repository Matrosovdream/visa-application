<?php
namespace App\Actions\Web;

use App\Services\LocationService;
use App\Models\Article;


class IndexActions {

    public function index( $request ) {

        return array(
            'title' => 'Homepage',
            'articles' => Article::paginate(3),
            'location' => LocationService::getLocation( $request->ip() )
        );

    }

}
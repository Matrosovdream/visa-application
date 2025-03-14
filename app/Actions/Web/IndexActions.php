<?php
namespace App\Actions\Web;

use App\Services\LocationService;
use App\Repositories\Country\CountryRepo;


class IndexActions {

    protected $locationService;
    protected $countryRepo;

    public function __construct( 
        LocationService $locationService, 
        CountryRepo $countryRepo 
        ) {

        $this->locationService = $locationService;

        // References
        $this->countryRepo = $countryRepo;


    }

    public function index( $request ) {

        return array(
            'title' => 'Homepage',
            'location' => $this->locationService->getLocation( $request->ip() )
        );

    }

    public function directionApply( $request ) {

        $country_from = $this->countryRepo->getById( $request->country_from );
        $country_to = $this->countryRepo->getById( $request->country_to );

        return [
            'country' => $country_to['slug'], 
            'nationality' => $country_from['slug']
        ];

    }

}
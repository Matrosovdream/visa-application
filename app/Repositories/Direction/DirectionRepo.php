<?php
namespace App\Repositories\Direction;

use App\Repositories\AbstractRepo;
use App\Models\TravelDirection;
use App\Repositories\Country\CountryRepo;


class DirectionRepo extends AbstractRepo
{

    protected $model;

    protected $fields = [
        //'title' => [ 'type' => 'string', 'required' => true ],
    ];

    private $countryRepo;

    public function __construct()
    {
        $this->model = new TravelDirection();
        $this->countryRepo = new CountryRepo();
    }

    public function mapItem($item)
    {
        if (!$item) return null;

        $res = [
            'id' => $item->id,
            'name' => $item->name,
            'slug' => $item->slug,
            'countryFrom' => $this->countryRepo->mapItem($item->countryFrom),
            'countryTo' => $this->countryRepo->mapItem($item->countryTo),
            'visa_req' => $item->visa_req,
            'Model' => $item
        ];
        return $res;
    }

}
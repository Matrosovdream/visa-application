<?php
namespace App\Actions\Dashboard;

use App\Repositories\Direction\DirectionRepo;
use App\Repositories\Country\CountryRepo;
use App\Helpers\adminSettingsHelper;

class DirectionActions
{

    public $directionRepo;
    public $countryRepo;

    public function __construct()
    {
        $this->directionRepo = new DirectionRepo();
        $this->countryRepo = new CountryRepo();
    }

    public function index($request = null)
    {

        // Filter
        if ($request->visa_req == 3)
            $request->visa_req = null;
        if ($request->country_from == 'all')
            $request->country_from = null;
        if ($request->country_to == 'all')
            $request->country_to = null;

        $filter = [
            'visa_req' => $request->visa_req ?? null,
            'country_from_id' => $request->country_from ?? null,
            'country_to_id' => $request->country_to ?? null
        ];

        $data = [
            'title' => 'Traveller directions',
            'directions' => $this->directionRepo->getAll($filter),
            'references' => $this->getReferences(),
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        return $data;
    }

    public function show($id)
    {
        $data = [
            'title' => 'Edit Field #' . $id,
            'direction' => $this->directionRepo->getById($id),
            'references' => $this->getReferences(),
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];
        return $data;
    }

    public function create()
    {

    }

    public function store($request)
    {

    }

    public function update($request, $id)
    {
        $data['visa_req'] = $request->visa_req;
        return $this->directionRepo->update($id, $data);
    }

    public function destroy($id)
    {
        $this->directionRepo->deleteById($id);
    }

    public function getReferences()
    {
        return [
            'country' => $this->countryRepo->getAll([], $paginate = 1000),
            'visa_req' => [
                ['id' => 3, 'name' => 'All visas'],
                ['id' => 1, 'name' => 'Visa required'],
                ['id' => 0, 'name' => 'No visa'],
            ]
        ];
    }

}
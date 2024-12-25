<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Dashboard\TravellerFieldsActions;

class DashboardTravellerFieldsController extends Controller
{

    public $perPage = 10;

    private $actions;

    public function __construct(TravellerFieldsActions $actions)
    {
        $this->actions = $actions;
    }
    
    public function index()
    {
        $data = $this->actions->index(); //dd($data);
        return view('dashboard.travellerfields.index', $data);
    }

    public function show($id)
    {
        $data = $this->actions->show( $id );
        return view('dashboard.travellerfields.show', $data);
    }

    public function create()
    {
        $data = $this->actions->create();
        return view('dashboard.travellerfields.create', $data);
    }

    public function store( Request $request )
    {
        $res = $this->actions->store($request);

        if ($res) {
            return redirect()->route('dashboard.travellerfields.index');
        } else {
            return redirect()->back();
        }
    }

    public function update($id, Request $request)
    {
        $this->actions->update($id, $request);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->actions->destroy($id);
        return redirect()->route('dashboard.travellerfields.index');
    }

}

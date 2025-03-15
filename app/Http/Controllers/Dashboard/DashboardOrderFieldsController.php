<?php
namespace App\Http\Controllers\Dashboard;

use App\Actions\Dashboard\OrderFieldsActions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardOrderFieldsController extends Controller
{

    public $perPage = 10;

    private $actions;

    public function __construct(OrderFieldsActions $actions)
    {
        $this->actions = $actions;
    }
    
    public function index( Request $request )
    {
        $data = $this->actions->index( $request );
        return view('dashboard.orderfields.index', $data);
    }

    public function show($id)
    {

        $data = $this->actions->show( $id );
        return view('dashboard.orderfields.show', $data);
    }

    public function create()
    {
        $data = $this->actions->create();
        return view('dashboard.orderfields.create', $data);
    }

    public function store( Request $request )
    {
        $res = $this->actions->store($request);

        if ($res) {
            return redirect()->route('dashboard.orderfields.index');
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
        return redirect()->route('dashboard.orderfields.index');
    }

}

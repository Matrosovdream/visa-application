<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Actions\Dashboard\DirectionActions;
use Illuminate\Http\Request;

class DashboardDirectionsController extends Controller
{

    private $directionActions;

    public function __construct()
    {
        $this->directionActions = new DirectionActions();
    }
    
    public function index( Request $request )
    {
        $data = $this->directionActions->index( $request );
        return view('dashboard.directions.index', $data);
    }

    public function show($direction_id)
    {
        $data = $this->directionActions->show($direction_id);
        return view('dashboard.directions.show', $data);
    }

    public function update(Request $request, $direction_id)
    {
        $data = $this->directionActions->update($request, $direction_id);
        return redirect()->route('dashboard.directions.show', $direction_id);
    }

}

<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Helpers\adminSettingsHelper;
use Illuminate\Http\Request;

class DashboardUsersController extends Controller
{

    public function index()
    {

        $data = [
            'title' => 'Users',
            'users' => User::paginate(10),
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        return view('dashboard.users.index', $data);
    }

    public function show($user_id)
    {
        $user = User::find($user_id);

        $data = [
            'title' => 'User details',
            'user' => $user,
            'roles' => Role::all(),
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        return view('dashboard.users.show', $data);
    }

    public function update($user_id, Request $request)
    {

        if( $request->action == 'save_general' ) {

            $request->validate([
                'name' => 'required',
                'role' => 'required',
            ]);

            $user = User::find($user_id);
            $user->update(request()->all());

            $user->setRole($request->role);

            return redirect()->route('dashboard.users.index');
        }

        if( $request->action == 'save_password' ) {

            $request->validate([
                'password' => 'required',
            ]);

            $user = User::find($user_id);
            $user->password = bcrypt($request->password);
            $user->save();

            return redirect()->route('dashboard.users.index');
        }

        $user = User::find($user_id);
        $user->update(request()->all());

        return redirect()->route('dashboard.users.index');
    }

    public function create()
    {

        $data = [
            'title' => 'Create user',
            'roles' => Role::all(),
            'sidebarMenu' => adminSettingsHelper::getSidebarMenu(),
        ];

        return view('dashboard.users.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required:email',
            'password' => 'required',
            'role' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $user->setRole($request->role);

        return redirect()->route('dashboard.users.index');
    }

    public function destroy($user_id)
    {
        $user = User::find($user_id);
        $user->delete();

        return redirect()->route('dashboard.users.index');
    }

}

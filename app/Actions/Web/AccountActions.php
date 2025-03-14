<?php
namespace App\Actions\Web;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountActions {

    public function index() {
        return array('title' => 'Dashboard');
    }

    public function settings() {
        return array('title' => 'Settings');
    }

    public function settingsUpdate($request) {

        $new_password = $request->new_password;

        // Update user password
        $user = Auth::user();
        $user->password = Hash::make($new_password);    
        $user->save();

        // Update user password
        Auth::user()->$new_password = bcrypt($new_password);

    }

}
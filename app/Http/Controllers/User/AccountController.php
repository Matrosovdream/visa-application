<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Actions\Web\AccountActions;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{

    protected $accountActions;

    public function __construct(AccountActions $accountActions)
    {
        $this->accountActions = $accountActions;
    }

    public function index()
    {
        return view(
            'web.account.index',
            $this->accountActions->index()
        );
    }

    public function settings()
    {
        return view(
            'web.account.settings', 
            $this->accountActions->settings()
        );
    }

    public function settingsUpdate( Request $request )
    {

        // Validate
        $request->validate([
            'current_password' => 'current_password',
            'new_password' => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required|min:8'
        ]);

        $current_password = $request->current_password;
        $new_password = $request->new_password;
        $new_password_confirmation = $request->new_password_confirmation;

        // Check for passwords identity
        if( $new_password != $new_password_confirmation ) {
            return redirect()->back()->with('error', 'New password and confirm password do not match');
        }

        // Check current password
        if( !Auth::attempt(['email' => Auth::user()->email, 'password' => $current_password]) ) {
            return redirect()->back()->with('error', 'Current password is incorrect');
        }

        $this->accountActions->settingsUpdate($request);

        return redirect()->back()->with('success', 'Settings updated successfully');
    }

}

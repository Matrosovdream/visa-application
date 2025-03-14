<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Actions\Web\ProfileActions;

class ProfileController extends Controller
{

    protected $profileActions;

    public function __construct(ProfileActions $profileActions)
    {
        $this->profileActions = $profileActions;
    }
    
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view(
            'profile.edit', 
            $this->profileActions->edit($request)
        );
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $this->profileActions->update($request);
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

}

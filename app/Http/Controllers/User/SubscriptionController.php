<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Web\SubscriptionActions;


class SubscriptionController extends Controller
{

    protected $subscriptionActions;

    public function __construct()
    {
        $this->subscriptionActions = new SubscriptionActions();
    }
    
    public function subscribe( Request $request )
    {

        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        // Return json response
        return $this->subscriptionActions->subscribe($validated['email']);
    }

}

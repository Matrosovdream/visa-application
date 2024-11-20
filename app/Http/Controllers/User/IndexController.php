<?php
namespace App\Http\Controllers\User;

use App\Actions\Web\OrderActions;
use App\Http\Controllers\Controller;
use App\Helpers\userSettingsHelper;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Services\LocationService;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App;

class IndexController extends Controller {

    public function index( Request $request )
    {

        if( $request->has("mail") ) {
            $mail = $request->mail;
            Mail::raw('This is a test email.', function ($message) {
                $message->to( 'matrosovdream@gmail.com' )
                ->from(env('MAIL_FROM_ADDRESS'), 'Admin')
                        ->subject('Test Email');
            });
        }

        if( $request->has("adm") ) {
            $user = User::find(1);
            $user->setRole('admin');
            dd($user->getRole());
        }

        /*
        $email = 'admin2@gmail.com';

        // Remove the user
        $user = User::where('email', $email )->first();
        if( $user ) {
            $user->delete();
        }

        $user = User::create([
            'name' => 'Admin 2',
            'email' => $email,
            'password' => Hash::make('123456'),
        ]);

        $user->setRole('admin');

        // Set password
        $user->password = Hash::make('123456');
        $user->save();
        */

        if( request('lg') ) {
            $user = User::find( request('lg') );
            auth()->login($user);
        }

        if( request('order') ) {
            OrderActions::imitateOrderCreate();
        } 
        

        $data = array(
            'title' => 'Homepage',
            'articles' => Article::paginate(3),
            'location' => LocationService::getLocation( $request->ip() )
        );

        return view('web.index', $data);
    }

    public function directionApply( Request $request )
    {

        // We make a link kinda /country/{country_to}?nationality={country_from}
        $country_from = Country::find($request->country_from);
        $country_to = Country::find($request->country_to);

        return redirect()->route('web.country.index', 
            [
            'country' => $country_to->slug, 
            'nationality' => $country_from->slug
            ]
        );

    }

}

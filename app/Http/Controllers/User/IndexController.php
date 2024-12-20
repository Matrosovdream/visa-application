<?php
namespace App\Http\Controllers\User;

use App\Actions\Web\OrderActions;
use App\Http\Controllers\Controller;
use App\Helpers\userSettingsHelper;
use App\Models\Country;
use App\Repositories\FormFieldValue\FormFieldValueRepo;
use Illuminate\Http\Request;
use App\Services\LocationService;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Repositories\FormFieldReference\FormFieldReferenceRepo;


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

        if( $request->has("log") ) {
            
            /*$product_id = 1;
            //$filters = ['entity' => 'traveller', 'section' => 'passport'];
            $filters = [];
            $fields = (new FormFieldReferenceRepo())->getProductFields( $product_id, $filters );

            dd($fields);
            */

            // Cart values
            $cartValueRepo = new FormFieldValueRepo();
            $cart_id = 1;
            $field_id = 1;
            $value = 'test';

            $cartValueRepo->setCartValue($cart_id, $field_id, $value);
            $value = $cartValueRepo->getCartValue($cart_id, $field_id, $value);
            $values = $cartValueRepo->getCartValues($cart_id);
            //dd($value);

            // Order values
            $order_id = 1;
            $values = (new FormFieldValueRepo())->getOrderValues($order_id);
            dd($values);
            

            // Traveller values
            $traveller_id = 1;
            $values = (new FormFieldValueRepo())->getTravellerValues($traveller_id);
            dd($values);

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

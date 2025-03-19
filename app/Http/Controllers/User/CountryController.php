<?php
namespace App\Http\Controllers\User;

use App;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\TravelDirection;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Helpers\userSettingsHelper;
use App\Services\GlobalsService;
use App\Repositories\Cart\CartRepoStore;
use App\Repositories\Cart\CartRepo;
use App\Models\Cart;
use App\Repositories\FormFieldReference\FormFieldReferenceRepo;


class CountryController extends Controller
{

    protected $cartRepoStore;

    public function __construct() {
        $this->cartRepoStore = new CartRepoStore();
    }

    public function index(Request $request)
    {

        $data = $this->getDirectionData( $request );
//dd($data['products']);
        if ( $data['country'] ) {
            return view('web.country.index', $data);
        } 

    }

    public function applyCartStep1(Request $request) {

        $data = $this->collectCartData( $request );

        $filters = ['entity' => 'order', 'section' => 'trip'];
        $data['formFields'] = (new FormFieldReferenceRepo())->getProductFields( 
            $data['product']['product_id'], 
            $filters 
        );
        
        $countryCode = $data['country']->code;

        //dd($data['formFields']);

        // Cart field values
        $data['cartFieldValues'] = $this->cartRepoStore->getCartValues( $data['cart']['fields']['id'] );

        // Traveller field values
        //$data['travellerFieldValues'] = [];

        // Prepare references
        foreach ($data['formFields'] as $key => $field) {
            if( $field['type'] == 'reference' ) {

                if( $field['field']['reference_code'] == 'airport' ) {

                    // Filter $field['options'] by country code
                    $field['field']['options'] = array_filter($field['field']['options'], function($airport) use ($countryCode) {
                        return $airport['iso_country'] == $countryCode;
                    });

                    $field['options'] = $field['field']['options'];

                    $data['formFields'][$key] = $field;
                }

            }
        }
        //dd($data['airports']);
        if( $request->has('lg') ) {
            //dd($data);
            dd($data['cart']['totals']);
        }
        

        $data['template'] = 'step-1';
        $data['subtitle'] = 'Trip Details';
        $data['prev_page'] = route('web.country.index', ['country' => $data['country']->slug, 'nationality' => $data['countryFrom']->slug]);
        $data['next_page'] = route('web.country.apply.cart.step2', [$data['country']->slug, $request->cart]);
        $data['action'] = route('web.country.apply.cart.update', [$data['country']->slug, $request->cart]);

        return view('web.country.cart', $data);

    }

    public function applyCartStep2(Request $request) {

        $data = $this->collectCartData( $request );


        $filters = ['entity' => 'traveller'];
        $data['formFields'] = (new FormFieldReferenceRepo())->getProductFields( 
            $data['product']['product_id'], 
            $filters 
        );
        $data['formFields'] = array_filter($data['formFields'], function($field) {
            return in_array($field['slug'], ['name', 'lastname', 'birthday']);
        });

        // Cart field values
        if( isset($data['cart']['meta']['travellers']) ) {
            $data['travellerFieldValues'] = json_decode($data['cart']['meta']['travellers'], true);
        } else {
            $data['travellerFieldValues'] = [];
        }

        $data['template'] = 'step-2';
        $data['subtitle'] = 'Your information';
        $data['prev_page'] = route('web.country.apply.cart.step1', [$data['country']->slug, $request->cart]);
        $data['next_page'] = route('web.country.apply.cart.step3', [$data['country']->slug, $request->cart]);
        $data['action'] = route('web.country.apply.cart.update', [$data['country']->slug, $request->cart]);

        return view('web.country.cart', $data);

    }

    public function applyCartStep3(Request $request) {

        $data = $this->collectCartData( $request );


        $filters = ['entity' => 'traveller'];
        $data['formFields'] = (new FormFieldReferenceRepo())->getProductFields( 
            $data['product']['product_id'], 
            $filters 
        );

        $data['personFormFields'] = array_filter($data['formFields'], function($field) {
            return in_array(
                $field['slug'], 
                ['name', 'lastname', 'birthday']
            );
        });

        $data['formFields'] = array_filter($data['formFields'], function($field) {
            return in_array(
                $field['slug'], 
                ['birth_country', 'passport', 'passport_expiration_date']
            );
        });

        

        // Cart field values
        $data['travellerFieldValues'] = $data['cart']['meta']['travellers'] ?? [];
        $data['travellerFieldValues'] = json_decode($data['travellerFieldValues'], true);

        // Set country birth if it's not set
        $birthField = (new FormFieldReferenceRepo())->getBySlug('birth_country');

        foreach ($data['travellerFieldValues'] as &$traveller) {
            if (!isset($traveller[$birthField->id])) {
                $traveller[$birthField->id] = $data['countryFrom']->id;
            }
        }

        //dd($data['travellerFieldValues'], $birthField->id);

        $data['template'] = 'step-3';
        $data['subtitle'] = 'Passport details';
        $data['prev_page'] = route('web.country.apply.cart.step2', [$data['country']->slug, $request->cart]);
        $data['next_page'] = route('web.country.apply.cart.confirm', [$data['country']->slug, $request->cart]);
        $data['action'] = route('web.country.apply.cart.update', [$data['country']->slug, $request->cart]);

        return view('web.country.cart', $data);

    }

    public function applyCartStepConfirm(Request $request) {

        $data = $this->collectCartData( $request );

        //dd($data);

        $data['template'] = 'confirm';
        $data['subtitle'] = 'Checkout';
        $data['prev_page'] = route('web.country.apply.cart.step3', [$data['country']->slug, $request->cart]);
        $data['next_page'] = '';
        $data['action'] = route('web.order.create-apply', [$data['country']->slug, $request->cart]);

        return view('web.country.cart', $data);

    }

    public function updateCart(Request $request) {

        $data = $this->collectCartData( $request );

        $cart = Cart::where('hash', $request->cart)->first();

        // Update cart meta
        CartRepoStore::updateMeta( $cart->id, $request->all() );

        // Update cart fields
        if( isset($request->fields) ) {
            $this->cartRepoStore->updateFields( $cart->id, $request->fields );
        }

        // Update cart product
        $cartRepo = CartRepo::find($cart->id);

        // Update travellers count
        if( count( $cartRepo['travellers'] ) > 0 ) {

            $fields['product'] = [
                'quantity' => count( $cartRepo['travellers'] )
            ];
            CartRepoStore::update( $cart->id, $fields );

        }

        // Return to $request->next_page
        return redirect( $request->next_page );
        
    }

    public function collectCartData( $request ) {

        $cart = CartRepo::getCartBy($request->cart, 'hash');
        if( !$cart ) {
            abort(404);
        }

        $data['cart'] = $cart;

        $data['country'] = Country::find($cart['meta']['country_to_id']);
        $data['countryFrom'] = Country::find( $cart['meta']['country_from_id'] );

        $data['cart'] = $cart;

        // Airports by country
        $data['airports'] = $data['country']->airports;

        $data['product'] = $cart['products'][0];

        $data['currency'] = $cart['fields']['currency'];

        $data['totals'] = $cart['totals'];

        $data['extras'] = [
            'required' => $data['product']['Model']->getRequiredExtras(),
            'optional' => $data['product']['Model']->getOptionalExtras()
        ];

        //dd($data);

        // Prepare travellers
        if( isset($data['cart']['meta']['travellers']) ) {
            $data['travellers'] = json_decode($data['cart']['meta']['travellers'], true);
        } else {
            $data['travellers'] = [];
        }

        //dd($data['cart']);

        return $data;

    }

    public function apply(Request $request, GlobalsService $globalsService)
    {

        $countryFrom = $this->findCountry( $request->nationality );
        $countryTo = $this->findCountry($request->country);

        //dd($request->all());

        $data = [
            'user_id' => auth()->user()->id ?? null,
            'status' => 'open',
            'product_id' => $request->product_id ?? null,
            'order_id' => null,
            'offer_id' => null,
            'quantity' => 1,
            'currency' => $globalsService->getActiveCurrency()->code,
            'country_from' => $countryFrom,
            'country_to' => $countryTo,
        ];
        $cart = CartRepoStore::create( $data );

        // Add cart hash to Cookie
        GlobalsService::setCart( $cart['fields']['id'] );

        return redirect()->route('web.country.apply.cart.step1', [$countryTo->slug, $cart['Model']->hash]);

    }

    public function findCountry($slug)
    {
        $country = Country::where('slug', $slug)->first();
        if ($country) { return $country; }
    }

    public function getCountries( $slug=null )
    {
        return Country::all()->filter(function($country) use ($slug) {
            return $country->slug != $slug;
        });
    }

    public function getDirectionData( $request ) {

        $countryTo = $this->findCountry($request->country);
        $countryFrom = $this->findCountry( $request->nationality );

        $direction = [];
        $products = [];

        if( isset($countryFrom) && isset($countryTo) ) {

            $direction = TravelDirection::where('country_from_id', $countryFrom->id)
            ->where('country_to_id', $countryTo->id)
            ->first();
            
            $product_ids = $direction->products;

            $products = [];
            foreach ($product_ids as $product) {
                $productData = Product::find($product->product_id);
                if( $productData ) {
                    $products[] = $productData;
                } 
            }

        }

        $data = [
            'country' => $countryTo,
            'countryFrom' => $countryFrom,
            'countries' => $this->getCountries($request->country),
            'direction' => $direction,
            'products' => $products,
            'currency' => 'USD',
            'menuTop' => userSettingsHelper::getTopMenu(),
            'title' => 'Travel'
        ];

        return $data;

    }

}

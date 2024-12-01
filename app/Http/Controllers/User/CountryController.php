<?php
namespace App\Http\Controllers\User;

use App;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\TravelDirection;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Helpers\userSettingsHelper;
use App\Services\CurrencyConverterService;
use App\Services\GlobalsService;
use App\Repositories\Cart\CartRepoStore;
use App\Repositories\Cart\CartRepo;




class CountryController extends Controller
{

    public function index(Request $request)
    {

        $data = $this->getDirectionData( $request );
//dd($data['products']);
        if ( $data['country'] ) {
            return view('web.country.index', $data);
        } 

    }

    public function applyCart(Request $request) {

        $countryFrom = $this->findCountry( $request->country );
        $cart = CartRepo::getCartBy($request->cart, 'hash');

        $data = $this->getDirectionData( $request );

        return view('web.country.apply', $data);

        dd( $cart);

    }

    public function apply(Request $request, GlobalsService $globalsService)
    {

        $countryFrom = $this->findCountry( $request->nationality );
        $countryTo = $this->findCountry($request->country);

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

        return redirect()->route('web.country.apply.cart', [$countryTo->slug, $cart['model']->hash, 'step' => 1]);


        $data = $this->getDirectionData( $request );

        $data['product'] = Product::find($request->product_id);
        $data['totalPrice'] = $data['product']->offers->first()->price;
        $data['currency'] = $globalsService->getActiveCurrency()->code;
        $data['extrasPrice'] = $data['product']->extras->sum('price');

        // Convert currency
        $data['totalPrice'] = CurrencyConverterService::convert('USD', $data['currency'], $data['totalPrice']);
        $data['extrasPrice'] = CurrencyConverterService::convert('USD', $data['currency'], $data['extrasPrice']);

        // Convert offers price
        $offers = $data['product']->offers;
        foreach ($offers as $offer) {
            $offer->price = CurrencyConverterService::convert('USD', $data['currency'], $offer->price);
        }
        $data['product']->offers = $offers;

        // Calculate price for every offer
        foreach ($data['product']->offers as $offer) {
            $offer->price = $offer->price + $data['extrasPrice'];
        }

        // Airports by country
        $data['airports'] = $data['country']->airports;

        // Convert extras price
        $extras = $data['product']->extras;
        foreach ($extras as $extra) {
            $extra->price = CurrencyConverterService::convert('USD', $data['currency'], $extra->price);
        }
        $data['product']->extras = $extras;

        if ( $data['country'] ) {
            return view('web.country.apply', $data);
        }

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

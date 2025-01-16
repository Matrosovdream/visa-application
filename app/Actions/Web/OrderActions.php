<?php
namespace App\Actions\Web;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\ProductOffers;
use App\Services\CurrencyConverterService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Traveller;
use App\Helpers\TravellerHelper;
use App\Repositories\Cart\CartRepo;
use App\Repositories\FormFieldValue\FormFieldValueRepo;



class OrderActions {

    public static function createOrderNew( Request $request, $user_id=null, $is_paid=false ) {

        $cart = CartRepo::find( $request->cart_id );

        // Set cart product
        $product = $cart['products'][0];
        $cartProduct = CartProduct::find( $product['id'] );

        $cartProduct->offer_id = $request->offer_id;
        $cartProduct->save();

        $cart = CartRepo::find( $request->cart_id );

        // User data
        $email = (new FormFieldValueRepo())->getCartValueBy( $request->cart_id, 'order', 'email' );
        $fullname = (new FormFieldValueRepo())->getCartValueBy( $request->cart_id, 'order', 'fullname' );
        $userdata = [
            'email' => $email,
            'fullname' => $fullname,
        ];

        // Create or find user by email
        if( $user_id ) {
            $USER = User::find($user_id);
        } elseif( auth()->user() ) {
            $USER = auth()->user();
        } else {
            // Create user
            $USER = self::createUserNew($userdata, $role = 'user');

            // Log in user
            auth()->login($USER);
        }

        // Create order
        $order = Order::create([
            'user_id' => $USER->id,
            'status_id' => 1,
            'payment_method_id' => 1,
            'total_price' => $cart['totals']['total_price'],
            'is_paid' => $is_paid,
        ]);

        // Set cart Order ID
        $cart['Model']->order_id = $order->id;
        $cart['Model']->save();

        // Add order meta fields
        self::addOrderMetaNew($order, $cart['meta']);

        // Add travellers
        $travellers = json_decode($cart['meta']['travellers'], true);
        if( isset($travellers) ) {
            self::addTravellersNew($order, $request->cart_id, $travellers);
        } 

        // Set cart product order ID
        $cartProduct->order_id = $order->id;
        $cartProduct->save();

        // Set order fields values from cart
        $fields = (new FormFieldValueRepo())->getCartValues( $request->cart_id );
        foreach( $fields as $values ) {
            (new FormFieldValueRepo())->setOrderValue($order->id, $values['field_id'], $values['value']);
        }

        // Set cart extra services
        if( isset($request->extra_ids) ) {

            $extras = $request->extra_ids;
            foreach( $extras as $extra_id ) {
    
                // Cart
                $cart['Model']->extraServices()->create([
                    'service_id' => $extra_id,
                ]);
    
                // Order
                $order->extraServices()->create([
                    'service_id' => $extra_id,
                ]);
                
    
            }
            
        }

        //dd($extras);

        
        // Add to history
        $order->history()->create([
            'user_id' => $USER->id,
            'action' => 'create',
            'comment' => 'Order created',
        ]);

        return $order;

        dd($cart);

    }

    public static function createOrderUser() {

        

    }

    public static function createOrder( Request $request, $user_id=null ) {

        // Create or find user by email
        if( $user_id ) {
            $USER = User::find($user_id);
        } elseif( auth()->user() ) {
            $USER = auth()->user();
        } else {
            // Create user
            $USER = self::createUser($request, $role = 'user');

            // Log in user
            auth()->login($USER);
        }

        // Calculate product price
        //$price = self::getProductPrice($request->product_id, $request->offer_id);

        // Calculate total price
        $totalPrice = $price * $request->quantity;

        // Create order
        $order = Order::create([
            'user_id' => $USER->id,
            'status_id' => 1,
            'payment_method_id' => 1,
            'total_price' => $totalPrice,
        ]);

        // Add order meta fields
        if( isset($request->meta) ) {
            self::addOrderMetaNew($order, $request->meta);
        } else {
            self::addOrderMeta($order, $request);
        }

        // Add travellers
        if( isset($request->travelers) ) {
            self::addTravellers($order, $request);
        } 
        
        // Create a cart
        $cart = Cart::create([
            'user_id' => $USER->id,
            'order_id' => $order->id,
            'session_id' => session()->getId(),
            'status' => 'active',
            'currency' => $request->currency,
        ]);

        // Add products to the cart
        CartProduct::create([
            'cart_id' => $cart->id,
            'order_id' => $order->id,
            'product_id' => $request->product_id,
            'offer_id' => $request->offer_id,
            'quantity' => $request->quantity,
            'price' => $price,
            'total' => $price * $request->quantity,
        ]);

        // Add to history
        $order->history()->create([
            'user_id' => $USER->id,
            'action' => 'create',
            'comment' => 'Order created',
        ]);

        return $order;

    }

    public static function getProductPrice( $product_id, $offer_id, $currency='USD' ) {

        $product = Product::find($product_id);
        $offer = ProductOffers::find($offer_id);

        $price = $offer->price + $product->extras->sum('price');
        $price = CurrencyConverterService::convert('USD', $currency, $price);

        return $price;

    }

    public static function createUser( $request, $role = 'user' ) {

        $user = User::firstOrCreate([
            'email' => $request->email,
        ], [
            'name' => $request->full_name,
            'email' => $request->email,
            'password' => bcrypt(Str::random(16)),
        ]);

        // Set role
        $user->setRole( $role );

        return $user;

    }

    public static function createUserNew( $data, $role = 'user' ) {

        $user = User::firstOrCreate([
            'email' => $data['email'],
        ], [
            'name' => $data['fullname'],
            'email' => $data['email'],
            'password' => bcrypt(Str::random(16)),
        ]);

        // Set role
        $user->setRole('user');

        return $user;

    }

    public static function addOrderMetaNew( $order, $fields ) {
        
        foreach( $fields as $code => $value ) { 
            $order->setMeta($code, $value);
        }

    }

    public static function addOrderMeta( $order, $request ) {

        $fields = [
            'country_to_id', 
            'country_to_code', 
            'country_from_id', 
            'country_from_code',
            'currency',
            'time_arrival',
            'full_name',
            'phone',
            'email',
        ];
        foreach ($fields as $field) {
            $value = $request->$field;
            if( is_array($value) ) {
                $value = json_encode($value);
            }

            if ( $value ) {
                $order->meta()->create([
                    'key' => $field,
                    'value' => $value,
                ]);
            }
        }

    }

    public static function addTravellersNew( $order, $cart_id, $travellers ) {

        foreach ($travellers as $traveller) {

            $name_id = (new FormFieldValueRepo())->getFieldBy( 'traveller', 'name' );
            $lastname_id = (new FormFieldValueRepo())->getFieldBy( 'traveller', 'lastname' );
            $birthday_id = (new FormFieldValueRepo())->getFieldBy( 'traveller', 'birthday' );
            $passport_id = (new FormFieldValueRepo())->getFieldBy( 'traveller', 'passport' );

            $data = [
                'name' => $traveller[ $name_id['id'] ],
                'lastname' => $traveller[ $lastname_id['id'] ],
                'birthday' => $traveller[ $birthday_id['id'] ],
                'passport' => $traveller[ $passport_id['id'] ],
            ];

            $travellerSet = $order->travellers()->create( $data );
            $travellerID = $travellerSet->id;
            foreach( $data as $key=>$value ) {
                $travellerSet->setMeta($key, $value);
            }

            // Set traveller fields values
            foreach( $traveller as $field_id => $value ) {
                (new FormFieldValueRepo())->setTravellerValue($travellerID, $field_id, $value);
            }

        }

    }

    public static function addTravellers( $order, $request ) {

        $travellers = TravellerHelper::preparePostTraveller( $request->travelers );
        //dd($travellers);
        foreach ($travellers as $traveller) {

            $travellerSet = $order->travellers()->create($traveller['traveller']);
            foreach( $traveller['meta'] as $metafield ) {
                $travellerSet->meta()->create($metafield);
            }

        }

    }

    public static function imitateOrderCreate() {

        $request = new Request([
            'product_id' => 1,
            'offer_id' => 1,
            'quantity' => 1,
            'currency' => 'USD',
            'country_to_id' => 14,
            'country_to_code' => 'AU',
            'country_from_id' => 11,
            'country_from_code' => 'AR',
            'time_arrival' => '2024-10-29',
            'full_name' => 'John Doe',
            'phone' => '+1234567890',
            'email' => '22@gmail.com', 
            'travelers' => [
                'name' => [
                    'John',
                    'Jane',
                ],
                'lastname' => [
                    'Doe',
                    'Doe',
                ],
                'birthday' => [
                    '1995-01-01',
                    '1990-01-01',
                ],
                'passport' => [
                    '123456111',
                    '123456555',
                ],
                'passport-expiration-day' => [
                    '25',
                    '13',
                ],
                'passport-expiration-month' => [
                    '5',
                    '12',
                ],
                'passport-expiration-year' => [
                    '2026',
                    '2029',
                ],
            ],
        ]);

        return self::createOrder($request);

    }

}
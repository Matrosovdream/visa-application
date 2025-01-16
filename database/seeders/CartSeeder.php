<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Repositories\Cart\CartRepoStore;
use App\Models\Country;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_id = 1;
        $product_id = 1;
        $countryFrom = Country::find(1);
        $countryTo = Country::find(2);
        $currency = 'USD';
        
        $data = [
            'user_id' => $user_id,
            'status' => 'open',
            'product_id' => $product_id,
            'order_id' => null,
            'offer_id' => null,
            'quantity' => 1,
            'currency' => $currency,
            'country_from' => $countryFrom,
            'country_to' => $countryTo,
        ];
        $cart = CartRepoStore::create( $data );

    }

}
<?php
namespace App\Helpers;

use App\Repositories\Cart\CartRepoStore;
use App\Models\Country;


class CartHelper {

    protected $cartRepoStore;

    public function __construct() {
        $this->cartRepoStore = new CartRepoStore();
    }

    public function createTestCart( $user_id=1 ) {

        // Faker for random data
        $faker = \Faker\Factory::create();

        // Main parameters
        $productId = 1;
        $userId = $user_id;
        $currency = 'USD';
        $quantity = 1;
        
        $countryFrom = Country::find(1);
        $countryTo = Country::find(2);

        // Cart field values
        $cartFieldValues = [
            '1' => $faker->date('m/d/Y', '01/11/2025'),
            '2' => $faker->numberBetween(1, 65),
            '3' => $faker->firstName,
            '4' => $faker->phoneNumber(),
            '5' => $faker->email,
        ];

        // Travellers
        $travellersCount = 3; 

        $travellers = [];
        for ($i = 0; $i < $travellersCount; $i++) {
            $travellers[] = [
                15 => $faker->firstName,
                16 => $faker->lastName,
                17 => $faker->date('m/d/Y', '01/11/2025'),
                18 => $faker->numerify('#########'),
                20 => $faker->date('m/d/Y', '01/30/2025'),
                21 => $faker->numberBetween(18, 65),
            ];
        }

        // Meta fields
        $metas = [
            'country_from_id' => $countryFrom->id,
            'country_from_code' => $countryFrom->code,
            'country_to_id' => $countryTo->id,
            'country_to_code' => $countryTo->code,
            'travellers_count' => $travellersCount,
            'travellers' => json_encode($travellers),
        ];

        // Create cart itself
        $data = [
            'user_id' => $userId,
            'status' => 'open',
            'currency' => $currency,
            'country_from' => $countryFrom,
            'country_to' => $countryTo,
            'product_id' => $productId,
            'quantity' => $quantity,
        ];

        $cart = $this->cartRepoStore->create( $data );

        // Set meta fields
        foreach ($metas as $key => $value) {
            $cart['Model']->setMeta($key, $value);
        }

        // Set field values
        $this->cartRepoStore->updateFields( $cart['Model']->id, $cartFieldValues );

        return $cart;


    }

}
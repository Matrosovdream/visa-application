<?php

namespace Tests\Feature;

use App\Traits\Tests\OrderTest;
use Tests\TestCase;

class ApplicationSecondFormTest extends TestCase
{

    use OrderTest;

    protected $initialPath = '/';

    public function test_apply_now_page() {

        // Params
        $country_from_code = 'armenia';
        $country_to_code = 'australia';

        // Prepare the request
        $params = [
            'country' => $country_to_code,
            'nationality' => $country_from_code,
            'product_id' => 1,
        ];

        $response = $this->get($this->initialPath . 'country/'.$country_to_code.'/apply-now?'.http_build_query($params));
        $response->assertStatus(302); // Redirect to the application page

        // Remove the cart item if it's 302 redirect
        if( $response->status() == 302 ) {
            $this->removeLatestCart();
        }

    }



}
<?php

namespace Tests\Feature;

use App\Traits\Tests\OrderTest;
use Tests\TestCase;

class ApplicationFirstFormTest extends TestCase
{

    use OrderTest;

    protected $initialPath = '/';

    public function test_country_page() {

        // Params
        $country_from = 'armenia';
        $country_to = 'australia';

        $response = $this->get($this->initialPath . 'country/' . $country_to . '?nationality=' . $country_from);
        $response->assertStatus(200);

    }



}
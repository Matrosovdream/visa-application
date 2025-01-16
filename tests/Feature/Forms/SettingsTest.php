<?php

namespace Tests\Feature;

use Tests\TestCase;

class SettingsTest extends TestCase
{

    protected $initialPath = '/';

    // Change language, should return 302 - redirect
    public function test_set_language(): void
    {
        $url = route('web.language.set');
        $response = $this->post($this->initialPath.$url, ['lang' => 'EN']);

        $response->assertStatus(302);
        $response->assertRedirect($this->initialPath);
    } 

    // Change currency, should return 302 - redirect
    public function test_set_currency(): void
    {
        $url = route('web.currency.set');
        $response = $this->post($this->initialPath.$url, ['currency' => 'USD']);
        
        $response->assertStatus(302);
        $response->assertRedirect($this->initialPath);
    }



}
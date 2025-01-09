<?php

namespace Tests\Feature;

use Tests\TestCase;

class WebPagesTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_front_page(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_about_page(): void
    {
        $response = $this->get('/about');

        $response->assertStatus(200);
    }

    public function test_contact_page(): void
    {
        $response = $this->get('/contact');

        $response->assertStatus(200);
    }

    public function test_privacy_page(): void
    {
        $response = $this->get('/privacy');

        $response->assertStatus(200);
    }

    public function test_terms_page(): void
    {
        $response = $this->get('/terms');

        $response->assertStatus(200);
    }

    public function test_404_page(): void
    {
        $response = $this->get('/404');

        $response->assertStatus(404);
    }

    public function test_500_page(): void
    {
        $response = $this->get('/500');

        $response->assertStatus(500);
    }

    public function test_503_page(): void
    {
        $response = $this->get('/503');

        $response->assertStatus(503);
    }


}

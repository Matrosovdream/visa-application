<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class DashboardPagesTest extends TestCase
{

    protected $initialPath = '/dashboard';

    protected $admin_id = 1;

    protected $userAdmin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userAdmin = User::find( $this->admin_id );
    }

    // Front page
    public function test_front_page(): void
    {
        $response = $this->actingAs($this->userAdmin)->get($this->initialPath);
        $response->assertStatus(200);
    }

    // Products page
    public function test_products_page(): void
    {
        $response = $this->actingAs($this->userAdmin)->get($this->initialPath . '/products');
        $response->assertStatus(200);
    }

    // Orders page
    public function test_orders_page(): void
    {
        $response = $this->actingAs($this->userAdmin)->get($this->initialPath . '/orders');
        $response->assertStatus(200);
    }

    // Payment gateways
    public function test_gateways_page(): void
    {
        $response = $this->actingAs($this->userAdmin)->get($this->initialPath . '/gateways');
        $response->assertStatus(200);
    }

    // Traveller fields
    public function test_traveller_fields_page(): void
    {
        $response = $this->actingAs($this->userAdmin)->get($this->initialPath . '/traveller-fields');
        $response->assertStatus(200);
    }

    // Countries
    public function test_countries_page(): void
    {
        $response = $this->actingAs($this->userAdmin)->get($this->initialPath . '/countries');
        $response->assertStatus(200);
    }

    // Travel directions
    public function test_travel_directions_page(): void
    {
        $response = $this->actingAs($this->userAdmin)->get($this->initialPath . '/directions');
        $response->assertStatus(200);
    }

    // Settings
    public function test_settings_page(): void
    {
        $response = $this->actingAs($this->userAdmin)->get($this->initialPath . '/settings');
        $response->assertStatus(200);
    }

    // Users
    public function test_users_page(): void
    {
        $response = $this->actingAs($this->userAdmin)->get($this->initialPath . '/users');
        $response->assertStatus(200);
    }

    



}
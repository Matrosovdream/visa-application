<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class WebPagesTest extends TestCase
{

    protected $initialPath = '/';

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user
        $this->user = User::factory()->create();
    }

    protected function tearDown(): void
    {
        // Delete the user
        $this->user->delete();

        parent::tearDown();
    }

    // Front page
    public function test_front_page(): void
    {
        $response = $this->get($this->initialPath);
        $response->assertStatus(200);
    }

    // 404 page
    public function test_404_page(): void
    {
        $response = $this->get($this->initialPath . 'non-existing-page');
        $response->assertStatus(404);
    }

    // Login page
    public function test_login_page(): void
    {
        $response = $this->get($this->initialPath . 'login');
        $response->assertStatus(200);
    }

    // Register page
    public function test_register_page(): void
    {
        $response = $this->get($this->initialPath . 'register');
        $response->assertStatus(200);
    }

    // Forgot password page
    public function test_forgot_password_page(): void
    {
        $response = $this->get($this->initialPath . 'forgot-password');
        $response->assertStatus(200);
    }

    // Reset password page
    public function test_reset_password_page(): void
    {
        $response = $this->get($this->initialPath . 'forgot-password');
        $response->assertStatus(200);
    }

    // Account page
    public function test_account_page(): void
    {
        $response = $this->actingAs($this->user)->get($this->initialPath . 'account');
        $response->assertStatus(200);
    }

    // Orders page
    public function test_orders_page(): void
    {
        $response = $this->actingAs($this->user)->get($this->initialPath . 'account/orders');
        $response->assertStatus(200);
    }

    // Settings page
    public function test_settings_page(): void
    {
        $response = $this->actingAs($this->user)->get($this->initialPath . 'account/settings');
        $response->assertStatus(200);
    }

}

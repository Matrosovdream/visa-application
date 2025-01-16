<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Traits\Tests\OrderTest;

class WebPagesTest extends TestCase
{

    // Create carts, order and remove it after use
    use OrderTest;

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

    // Articles page
    public function test_articles_page(): void
    {
        $response = $this->get($this->initialPath . 'articles');
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

    // All steps of the cart
    public function test_cart_page() {

        $cart = $this->createCart();

        // Routes to check
        $routes = [
            'web.country.apply.cart.step1',
            'web.country.apply.cart.step2',
            'web.country.apply.cart.step3',
            'web.country.apply.cart.confirm'
        ];

        foreach( $routes as $route ) {
            $url = route($route, ['country' => 'australia', 'cart' => $cart['Model']->hash]);
            $response = $this->get($url);
            $response->assertStatus(200);
        }

        // Remove the cart item
        $this->removeCart();

    }

    // Order preview page
    public function test_order_preview_page() {

        // Create order
        $order = $this->createOrder();

        // web.order.show
        $url = route('web.order.show', ['order_hash' => $order->hash]);
        $response = $this->get($url);
        $response->assertStatus(200);

        // Remove order
        $this->removeOrder();

    }

    // Order details page route web.account.order
    public function test_order_details_page() {

        // Create order
        $order = $this->createOrder( $user_id = 1, $is_paid = true );

        // web.account.order
        $url = route('web.account.order', ['order_id' => $order->id]);
        $response = $this->actingAs( $order->user )->get($url);
        $response->assertStatus(200);

        // Remove order
        $this->removeOrder();

    }

    // Traveller details page route web.account.order.trip
    public function test_traveller_details_page() {

        // Create order
        $order = $this->createOrder( $user_id = 1, $is_paid = true );

        // web.account.order.trip
        $url = route('web.account.order.trip', ['order_id' => $order->id]);
        $response = $this->actingAs( $order->user )->get($url);
        $response->assertStatus(200);

        // Remove order
        $this->removeOrder();

    }

    // Documents page route web.account.order.documents
    public function test_documents_page() {

        // Create order
        $order = $this->createOrder( $user_id = 1, $is_paid = true );

        // web.account.order.documents
        $url = route('web.account.order.documents', ['order_id' => $order->id]);
        $response = $this->actingAs( $order->user )->get($url);
        $response->assertStatus(200);

        // Remove order
        $this->removeOrder();

    }

    // Order traveller pages
    public function test_order_traveller_pages() {

        // Create order
        $order = $this->createOrder( $user_id = 1, $is_paid = true );
        $traveller = $order->travellers()->first();
        //dd($traveller);

        $routes = [
            'web.account.order.applicant.documents',
            'web.account.order.applicant.personal',
            'web.account.order.applicant.passport',
            'web.account.order.applicant.family',
        ];

        foreach( $routes as $route ) {
            $url = route($route, ['order_id' => $order->id, 'applicant_id' => $traveller->id]);
            $response = $this->actingAs( $order->user )->get($url);
            $response->assertStatus(200);
        }

        // Remove order
        $this->removeOrder();

    }






    
}

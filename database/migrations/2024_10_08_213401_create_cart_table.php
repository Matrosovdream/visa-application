<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->on('users')->nullable();
            $table->string('session_id')->nullable();
            $table->string('hash')->nullable();
            $table->foreignId('order_id')->on('orders')->nullable();
            $table->string('status')->default('open');
            $table->string('currency')->default('USD');
            $table->timestamps();
        });

        Schema::create('cart_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->on('carts');
            $table->foreignId('order_id')->on('orders')->nullable();
            $table->foreignId('product_id')->on('products');
            $table->foreignId('offer_id')->on('product_offers')->nullable();
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });

        Schema::create('cart_meta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->on('carts');
            $table->string('key');
            $table->text('value')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
        Schema::dropIfExists('cart_products');
        Schema::dropIfExists('cart_meta');
    }
};

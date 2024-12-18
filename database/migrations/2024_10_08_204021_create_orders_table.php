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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('hash')->unique();
            $table->foreignId('user_id')->on('users')->nullable();
            $table->string('status_id')->on('order_statuses')->nullable();
            $table->string('payment_method_id')->on('payment_gateways')->nullable();
            $table->string('currency')->default('USD');
            $table->boolean('is_paid')->default(false);
            $table->decimal('total_price', 10, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('order_meta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->on('orders');
            $table->string('key');
            $table->text('value');
            $table->timestamps();
        });

        Schema::create('order_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->on('users')->nullable();
            $table->foreignId('order_id')->on('orders');
            $table->string('payment_gateway_id');
            $table->string('transaction_id');
            $table->string('status');
            $table->string('currency');
            $table->decimal('amount', 10, 2);
            $table->text('payment_response');
            $table->timestamps();
        });

        Schema::create('order_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('color')->nullable();
            $table->boolean('is_default')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('order_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->on('orders');
            $table->foreignId('user_id')->on('users')->nullable();
            $table->text('action');
            $table->text('comment')->nullable();
            $table->longText('data')->nullable();
            $table->timestamps();
        });

        Schema::create('order_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->on('order');
            $table->foreignId('file_id')->on('files');
            $table->string('description')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_meta');
        Schema::dropIfExists('order_payments');
        Schema::dropIfExists('order_statuses');
        Schema::dropIfExists('order_history');
        Schema::dropIfExists('order_certificates');
    }
};

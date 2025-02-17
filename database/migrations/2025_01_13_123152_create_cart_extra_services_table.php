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
        Schema::create('cart_extra_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->on('carts');
            $table->foreignId('service_id')->on('product_extras');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_extra_services');
    }
};

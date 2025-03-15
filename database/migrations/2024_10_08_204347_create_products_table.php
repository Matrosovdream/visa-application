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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->decimal('price', 10, 2);
            $table->boolean('published')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('product_meta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->on('products');
            $table->string('key');
            $table->text('value');
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('product_countries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->on('products');
            $table->foreignId('country_id')->on('countries');
            $table->timestamps();
        });

        Schema::create('product_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->on('products');
            $table->string('name');
            $table->string('type')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('product_extras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->on('products');
            $table->string('name');
            $table->string('type')->nullable();
            $table->decimal('price', 10, 2);
            $table->boolean('required')->default(false);
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('product_extras_meta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('extra_id')->on('product_extras');
            $table->string('key');
            $table->string('value');
            $table->timestamps();
        });

        Schema::create('product_offers_meta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')->on('product_offers');
            $table->string('key');
            $table->string('value');
            $table->timestamps();
        });

        Schema::create('product_fields_reference', function (Blueprint $table) {
            $table->id();
            $table->foreignId('field_id')->on('order_fields');
            $table->foreignId('product_id')->on('products')->nullable();
            $table->string('entity');
            $table->string('section')->nullable();
            $table->string('placeholder')->nullable();
            $table->boolean('required')->default(false);
            $table->string('default_value')->nullable(); 
            $table->string('classes')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_meta');
        Schema::dropIfExists('product_countries');
        Schema::dropIfExists('product_offers');
        Schema::dropIfExists('product_extras');
        Schema::dropIfExists('product_extras_meta');
        Schema::dropIfExists('product_offers_meta');
        Schema::dropIfExists('product_fields_reference');
    }
};

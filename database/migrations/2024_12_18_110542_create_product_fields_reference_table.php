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
        Schema::create('product_fields_reference', function (Blueprint $table) {
            $table->id();
            $table->foreignId('field_id')->on('order_fields');
            $table->foreignId('product_id')->on('products');
            $table->string('entity');
            $table->string('section')->nullable();
            $table->boolean('required')->default(false);
            $table->string('default_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_fields_reference');
    }
};

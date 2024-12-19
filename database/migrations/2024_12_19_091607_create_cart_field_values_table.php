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
        Schema::create('cart_field_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->on('carts');
            $table->foreignId('field_id')->on('reference_form_fields');
            $table->text('value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_field_values');
    }
};

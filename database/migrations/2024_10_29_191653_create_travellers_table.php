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
        Schema::create('travellers', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();
            $table->string('name')->nullable();
            $table->string('lastname')->nullable();
            $table->string('birthday')->nullable();
            $table->string('passport')->nullable();
            $table->timestamps();
        });

        Schema::create('traveller_meta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('traveller_id')->on('travellers');
            $table->string('key');
            $table->text('value')->nullable();
            $table->timestamps();
        });

        Schema::create('traveller_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('traveller_id')->on('travellers');
            $table->foreignId('file_id')->on('files');
            $table->timestamps();
        });

        Schema::create('traveller_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('traveller_id')->on('travellers');
            $table->foreignId('order_id')->on('orders');
            $table->timestamps();
        });

        Schema::create('traveller_field_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('traveller_id')->on('travellers');
            $table->foreignId('field_id')->on('reference_form_fields');
            $table->text('value');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travellers');
        Schema::dropIfExists('traveller_meta');
        Schema::dropIfExists('traveller_documents');
        Schema::dropIfExists('traveller_orders');
        Schema::dropIfExists('traveller_field_values');
    }
};

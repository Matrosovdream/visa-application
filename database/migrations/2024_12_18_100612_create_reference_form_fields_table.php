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
        Schema::create('reference_form_fields', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('entity');
            $table->string('type');
            $table->string('section')->nullable();
            $table->string('placeholder')->nullable();
            $table->text('tooltip')->nullable();
            $table->text('description')->nullable();
            $table->text('default_value')->nullable();
            $table->string('reference_code')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('default')->nullable();
            $table->boolean('is_email')->nullable();
            $table->boolean('is_phone')->nullable();
            $table->boolean('is_fullname')->nullable();
            $table->boolean('is_name')->nullable();
            $table->boolean('is_lastname')->nullable();
            $table->boolean('is_birthday')->nullable();
            $table->boolean('is_passport')->nullable();
            $table->string('classes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reference_form_fields');
    }
};

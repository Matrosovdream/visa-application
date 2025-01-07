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
            $table->boolean('default')->default(false);
            $table->boolean('is_email')->default(false);
            $table->boolean('is_phone')->default(false);
            $table->boolean('is_fullname')->default(false);
            $table->boolean('is_name')->default(false);
            $table->boolean('is_lastname')->default(false);
            $table->boolean('is_birthday')->default(false);
            $table->boolean('is_passport')->default(false);
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

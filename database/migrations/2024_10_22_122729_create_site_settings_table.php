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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('symbol');
            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('code')->unique();
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->integer('ref_id')->unique();
            $table->string('identity')->unique();
            $table->string('type')->nullable();
            $table->string('name');
            $table->foreignId('country_id')->on('countries')->nullable();
            $table->string('continent')->nullable();
            $table->string('iso_country')->nullable();
            $table->string('iso_region')->nullable();
            $table->string('municipality')->nullable();
            $table->string('wiki_link')->nullable();

            $table->timestamps();
        });

        Schema::create('travel_directions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('country_from_id')->on('countries');
            $table->foreignId('country_to_id')->on('countries');
            $table->string('country_from_code');
            $table->string('country_to_code');
            $table->boolean('visa_req')->default(false);
        });

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
        Schema::dropIfExists('site_settings');
        Schema::dropIfExists('languages');
        Schema::dropIfExists('currencies');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('airports');
        Schema::dropIfExists('travel_directions');
        Schema::dropIfExists('reference_form_fields');
    }
};

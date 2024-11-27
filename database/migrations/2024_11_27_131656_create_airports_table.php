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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airports');
    }
};

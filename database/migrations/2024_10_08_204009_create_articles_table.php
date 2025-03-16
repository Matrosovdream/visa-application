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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->text('summary')->nullable();
            $table->text('content')->nullable();
            $table->foreignId('author_id')->on('users');
            $table->string('image')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('article_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->on('articles')->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->text('short_description')->nullable();
            $table->text('summary')->nullable();
            $table->text('content')->nullable();
            $table->softDeletes();
            $table->timestamps();
         
            $table->unique(['article_id','locale']);
            
        });

        Schema::create('article_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('article_group_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_group_id')->on('article_groups')->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
         
            $table->unique(['article_group_id','locale']);
        });

        Schema::create('article_group_article', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->on('articles')->onDelete('cascade');
            $table->foreignId('article_group_id')->on('article_groups')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
        Schema::dropIfExists('article_translations');
    }
};

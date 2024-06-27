<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schemation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprintrint;
use Illuminate\Database\Migrations\Migrationhema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('language');
            $table->foreignId('category_id')->references('id')->on('categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('author_id')->references('id')->on('admins')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title');
            $table->text('image');
            $table->string('slug');
            $table->text('content');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->boolean('is_breaking_news')->default(0);
            $table->boolean('show_at_slider')->default(0);
            $table->boolean('show_at_popular')->default(0);
            $table->boolean('status')->default(0);
            $table->boolean('is_approved')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};

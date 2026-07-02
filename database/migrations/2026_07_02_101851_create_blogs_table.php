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
        Schema::create('blogs', function (Blueprint $table) {
                $table->id();
                $table->string('title', 255);
                $table->string('slug', 255)->unique();
                $table->string('category', 100); // Construction Insights, Real Estate Tips, etc.
                $table->string('author_name', 150)->default('mBuild Tech Team');
                $table->string('cover_image', 255)->nullable();
                $table->longText('body_content'); // Storing structured layouts/markdown
                
                $table->string('meta_title', 255)->nullable();
                $table->text('meta_description')->nullable();
                $table->string('keywords')->nullable();
                
                $table->boolean('is_published')->default(true);
                $table->timestamp('published_at')->nullable();
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};

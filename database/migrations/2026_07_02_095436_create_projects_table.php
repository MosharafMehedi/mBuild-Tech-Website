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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            
            $table->enum('classification', ['residential', 'commercial', 'industrial'])->default('residential');
            $table->enum('status', ['ongoing', 'completed', 'upcoming'])->default('ongoing');
            
            $table->integer('progress_foundation')->default(0)->nullable();
            $table->integer('progress_casting')->default(0)->nullable();
            $table->integer('progress_finishing')->default(0)->nullable();
            
            $table->text('description'); 
            $table->longText('body')->nullable();
            
            $table->string('location');
            $table->string('address')->nullable();
            $table->string('plot_size')->nullable();
            $table->integer('floors')->nullable();
            $table->integer('units')->nullable();
            $table->string('size_range')->nullable();
            $table->string('price_range')->nullable();
            $table->date('handover_date')->nullable();
            $table->string('rajuk_no')->nullable();
            
            $table->json('amenities')->nullable();
            $table->json('gallery')->nullable();
            $table->string('cover_image')->nullable();
            
            $table->enum('visibility', ['public', 'draft'])->default('public');
            $table->boolean('is_featured')->default(false);
            
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('brochure_file', 255)->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
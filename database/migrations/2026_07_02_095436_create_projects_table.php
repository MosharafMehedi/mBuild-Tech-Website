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
            $table->string('name', 255);
            $table->string('slug', 255)->unique();
            $table->enum('classification', ['residential', 'commercial', 'industrial']);
            $table->enum('status', ['completed', 'ongoing', 'upcoming'])->default('ongoing');

            $table->string('land_area', 100)->nullable();
            $table->string('storied_metrics', 100)->nullable();
            $table->integer('units')->nullable()->default(0);
            $table->date('handover_date')->nullable();

            $table->integer('progress_foundation')->default(0);
            $table->integer('progress_casting')->default(0);
            $table->integer('progress_finishing')->default(0);

            $table->string('location', 255);
            $table->text('map_embed_url')->nullable();
            $table->string('cover_image', 255)->nullable();
            $table->json('gallery_images')->nullable();
            $table->string('brochure_path', 255)->nullable();

            $table->string('meta_title', 255)->nullable();
            $table->text('meta_description')->nullable();

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

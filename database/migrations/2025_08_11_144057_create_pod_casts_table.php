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
        Schema::create('pod_casts', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Breaking Free from Mental Chains
            $table->string('slug')->unique()->nullable();
            $table->string('thumbnail')->nullable(); // Thumbnail image
            $table->string('video_url'); // YouTube/Video Embed Link
            $table->text('description')->nullable();
            $table->date('published_at')->nullable();
            $table->integer('duration')->nullable(); // in minutes
            $table->boolean('is_latest')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pod_casts');
    }
};

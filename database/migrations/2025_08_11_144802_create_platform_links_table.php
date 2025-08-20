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
        Schema::create('platform_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('podcast_id')->constrained('pod_casts')->onDelete('cascade');
            $table->string('platform_name'); // Spotify, Apple Podcasts
            $table->string('platform_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platform_links');
    }
};

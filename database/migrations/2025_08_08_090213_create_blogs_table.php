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
            $table->string('title'); // Title of the blog post
            $table->text('content'); // Content of the blog post
            $table->string('slug')->unique(); // Unique slug for the blog post
            $table->string('author')->nullable(); // Author of the blog post
            $table->string('image')->nullable(); // Image associated with the blog post
            $table->boolean('published')->default(false); // Published status of the blog post
            $table->timestamp('published_at')->nullable(); // Timestamp for when the blog post was published
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

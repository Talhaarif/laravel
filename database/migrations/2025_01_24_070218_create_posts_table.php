<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // User relationship
            $table->string('caption');
            $table->string('slug')->unique(); // For SEO-friendly URLs
            $table->json('hashtags')->nullable(); // Array of hashtags
            $table->json('media')->nullable(); // Array for images/videos
            $table->timestamp('scheduled_at')->nullable(); // For scheduled posts
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}

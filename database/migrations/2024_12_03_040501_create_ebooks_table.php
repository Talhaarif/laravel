<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEbooksTable extends Migration
{
    public function up(): void
    {
        Schema::create('ebooks', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('title');
            $table->string('author');
            $table->date('release_date');
            $table->json('categories')->nullable(); // Store categories as JSON
            $table->integer('number_of_pages');
            $table->string('language');
            $table->decimal('rating', 2, 1)->nullable(); // e.g., 4.5
            $table->text('overview');
            $table->string('instructor_name');
            $table->text('instructor_bio');
            $table->string('instructor_profile_image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ebooks');
    }
}

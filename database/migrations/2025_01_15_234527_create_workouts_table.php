<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('workouts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->string('category'); // e.g., biceps, triceps, chest
            $table->string('cal');
            $table->string('duration'); // e.g., 30 mins
            $table->text('overview');
            $table->string('kcal'); // Estimated calories burned
            $table->unsignedBigInteger('views_count')->default(0); // For trending workouts
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('workouts');
    }
};

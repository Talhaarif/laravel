<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealRatingsTable extends Migration
{
    public function up()
    {
        Schema::create('meal_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meal_id')->constrained('meals')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('rating')->default(0); // Rating value (1-5)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('meal_ratings');
    }
}


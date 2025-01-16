<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealsTable extends Migration
{
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image');
            $table->float('rating')->default(0); // Meal rating (0-5)
            $table->string('duration');
            $table->text('description');
            $table->text('overview');
            $table->string('language');
            $table->integer('modules');
            $table->string('admin_name');
            $table->string('admin_role');
            $table->string('admin_image');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('meals');
    }
}

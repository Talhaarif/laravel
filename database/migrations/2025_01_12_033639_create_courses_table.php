<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image');
            $table->decimal('rating', 2, 1)->default(0.0);
            $table->string('duration');
            $table->text('description');
            $table->text('overview');
            $table->string('admin_name');
            $table->string('admin_role');
            $table->string('admin_image');
            $table->string('language');
            $table->integer('modules');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('title');
            $table->string('image')->nullable();
            $table->decimal('rating', 2, 1)->default(0);
            $table->string('duration')->nullable();
            $table->text('description');
            $table->text('overview');
            $table->string('language');
            $table->string('admin_name');
            $table->string('admin_role');
            $table->string('admin_image')->nullable();
            $table->integer('views')->default(0); // For tracking trending articles
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToEbooksTable extends Migration
{
    public function up()
    {
        Schema::table('ebooks', function (Blueprint $table) {
            $table->string('slug')->unique()->after('title');
        });
    }

    public function down()
    {
        Schema::table('ebooks', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToGalleriesLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gallery_languages', function (Blueprint $table) {
            $table->string('title')->nullable()->change();
            $table->string('short_description')->nullable()->change();
            $table->text('content')->nullable()->change();
            $table->text('content_2')->nullable()->change();
            $table->string('slug')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gallery_languages', function (Blueprint $table) {
            //
        });
    }
}

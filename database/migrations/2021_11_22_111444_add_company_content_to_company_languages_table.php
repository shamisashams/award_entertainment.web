<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyContentToCompanyLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_languages', function (Blueprint $table) {
            $table->string("content_title")->after("description")->nullable();
            $table->text("content_description")->after("content_title")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_languages', function (Blueprint $table) {
            $table->dropColumn('content_title');
            $table->dropColumn('content_description');
        });
    }
}

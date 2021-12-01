<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubTitlesToCompanyLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_languages', function (Blueprint $table) {
            $table->string("content_sub_title_1")->after("content_description")->nullable();
            $table->text("content_description_2")->after("content_sub_title_1")->nullable();
            $table->string("content_sub_title_2")->after("content_description_2")->nullable();
            $table->text("content_description_3")->after("content_sub_title_2")->nullable();
            $table->string("content_sub_title_3")->after("content_description_3")->nullable();
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
            $table->dropColumn('content_sub_title_1');
            $table->dropColumn('content_sub_title_2');
            $table->dropColumn('content_sub_title_3');
            $table->dropColumn('content_description_2');
            $table->dropColumn('content_description_3');
        });
    }
}

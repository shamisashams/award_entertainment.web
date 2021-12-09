<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSettingsContentToCompanyLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_languages', function (Blueprint $table) {
            $table->string("country")->after("content_sub_title_3")->nullable();
            $table->string("address")->after("country")->nullable();
            $table->string("phone")->after("address")->nullable();
            $table->string("email")->after("phone")->nullable();
            $table->string("facebook")->after("email")->nullable();
            $table->string("linkedin")->after("facebook")->nullable();
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
            $table->dropColumn('country');
            $table->dropColumn('address');
            $table->dropColumn('phone');
            $table->dropColumn('email');
            $table->dropColumn('facebook');
            $table->dropColumn('linkedin');
        });
    }
}

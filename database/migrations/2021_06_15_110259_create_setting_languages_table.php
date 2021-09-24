<?php
/**
 *  database/migrations/2021_06_15_110259_create_setting_languages_table.php
 *
 * Date-Time: 15.06.21
 * Time: 15:03
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('setting_id')->constrained('settings');
            $table->foreignId('language_id')->constrained('languages');
            $table->index(['setting_id','language_id']);
            $table->string('value');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_languages');
    }
}

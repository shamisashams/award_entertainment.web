<?php
/**
 *  database/migrations/2021_06_14_111550_create_slider_languages_table.php
 *
 * Date-Time: 14.06.21
 * Time: 15:18
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSliderLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('slider_id')->constrained('sliders');
            $table->foreignId('language_id')->constrained('languages');
            $table->index(['slider_id','language_id']);
            $table->string('title')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('slider_languages');
    }
}

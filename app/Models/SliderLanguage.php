<?php
/**
 *  app/Models/SliderLanguage.php
 *
 * Date-Time: 14.06.21
 * Time: 15:21
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SliderLanguage
 * @package App\Models
 * @property integer $id
 * @property integer $slider_id
 * @property integer $language_id
 * @property string $title
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class SliderLanguage extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'slider_languages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slider_id',
        'language_id',
        'title',
        'description',
    ];
}

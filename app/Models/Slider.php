<?php
/**
 *  app/Models/Slider.php
 *
 * Date-Time: 14.06.21
 * Time: 15:17
 * @author Insite International <hello@insite.international>
 */
namespace App\Models;

use App\Traits\ScopeFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Slider
 * @package App\Models
 * @property integer $id
 * @property boolean $status
 * @property string $url
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Slider extends Model
{
    use HasFactory, softDeletes, ScopeFilter;
    const HOME = "homepage";

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sliders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'url',
        'type'
    ];

    public function getFilterScopes(): array
    {
        return [
            'id' => [
                'hasParam' => true,
                'scopeMethod' => 'id'
            ],
            'status' => [
                'hasParam' => true,
                'scopeMethod' => 'status'
            ],
            'title' => [
                'hasParam' => true,
                'scopeMethod' => 'titleLanguage'
            ]
        ];
    }

    /**
     * Return relationship slider languages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function languages(): HasMany
    {
        return $this->hasMany(SliderLanguage::class, 'slider_id');
    }
    public function availableLanguage()
    {
        return $this->languages()->where('language_id', '=', app()->getLocale());
    }

    /**
     * Return relationship slider language by language
     *
     * @param string|null $locale
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasMany|object|null
     */
    public function language(string $locale = null)
    {
        if (null === $locale) {
            $locale = app()->getLocale();
        }
        return $this->languages()->where('language_id', $locale)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function company(){
        return $this->belongsToMany(Company::class, 'company_sliders');
    }

    /**
     * @return HasMany
     */
    public function companies()
    {
        return $this->HasMany(CompanySlider::class);
    }

    /**
     * @param string $companyId
     * @return Model|HasMany|object|null
     */
    public function companyCheck(string $companyId)
    {
        return $this->companies()->where('company_id', $companyId)->first();
    }
}

<?php

namespace App\Models;

use App\Traits\ScopeCompanyFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Company extends Model
{
    use HasFactory, ScopeCompanyFilter;
    protected $fillable =[
        "status",
        "company_link"
    ];

    /**
     * @return HasMany
     */
    public function languages(): HasMany
    {
        return $this->hasMany(CompanyLanguage::class);
    }

    /**
     * @return HasMany
     */
    public function availableLanguage()
    {
        return $this->languages()->where('language_id', '=', app()->getLocale());
    }


    /**
     * @return array[]
     */
    public function getFilterScopes(): array
    {
        return [
            'id' => [
                'hasParam' => true,
                'scopeMethod' => 'id'
            ],
            'description' => [
                'hasParam' => true,
                'scopeMethod' => 'description'
            ],
            'status' => [
                'hasParam' => true,
                'scopeMethod' => 'status'
            ],
        ];
    }


    /**
     * @param string|null $locale
     * @return Model|HasMany|object|null
     */
    public function language(string $locale = null)
    {
        if (null === $locale) {
            $locale = app()->getLocale();
        }
        return $this->languages()->where('language_id', $locale)->first();
    }

    /**
     * @return MorphMany
     */
    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable')->where(['type' => File::FILE_DEFAULT]);
    }

    /**
     * @return MorphOne
     */
    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')->where(['type' => File::FILE_DEFAULT]);
    }

    /**
     * @return MorphOne
     */
    public function mainFile(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')->where(['type' => File::FILE_MAIN]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function documents(){
        return $this->belongsToMany(Document::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sliders(){
        return $this->belongsToMany(Slider::class, 'company_sliders');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pages(){
        return $this->belongsToMany(Page::class, 'company_pages');
    }
}

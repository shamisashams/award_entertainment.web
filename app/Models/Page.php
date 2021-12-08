<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Traits\ScopePageFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, ScopePageFilter, SoftDeletes;


    protected $fillable =[
        "status",
        'key'
    ];

    public function languages(): HasMany
    {
        return $this->hasMany(PageLanguage::class,'page_id');
    }

    public function availableLanguage()
    {
        return $this->languages()->where('language_id', '=', app()->getLocale());
    }
    public function getFilterScopes(): array
    {
        return [
            'id' => [
                'hasParam' => true,
                'scopeMethod' => 'id'
            ],
            'key' => [
                'hasParam' => true,
                'scopeMethod' => 'key'
            ],
            'title' => [
                'hasParam' => true,
                'scopeMethod' => 'title'
            ]

        ];
    }

    /**
     * Return relationship project language by language
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

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function company(){
        return $this->belongsToMany(Company::class, 'company_pages');
    }
    public function companies()
    {
        return $this->HasMany(CompanyPage::class);
    }
    public function companyCheck(string $companyId)
    {
        return $this->companies()->where('company_id', $companyId)->first();
    }

}

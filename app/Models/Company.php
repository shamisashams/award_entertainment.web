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
    public function languages(): HasMany
    {
        return $this->hasMany(CompanyLanguage::class);
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
}

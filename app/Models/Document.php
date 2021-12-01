<?php

namespace App\Models;

use App\Traits\ScopeDocumentFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory, SoftDeletes, ScopeDocumentFilter;
    protected $fillable = [
        "status",
        "link"
    ];

    public function languages(): HasMany
    {
        return $this->hasMany(DocumentLanguage::class);
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
            'title' => [
                'hasParam' => true,
                'scopeMethod' => 'title'
            ],
            'status' => [
                'hasParam' => true,
                'scopeMethod' => 'status'
            ],
        ];
    }
//    public function companies(){
//        return $this->belongsToMany(Company::class);
//    }

    public function language(string $locale = null)
    {
        if (null === $locale) {
            $locale = app()->getLocale();
        }
        return $this->languages()->where('language_id', $locale)->first();
    }
    public function company(){
        return $this->belongsToMany(Company::class);
    }
    public function companies()
    {
        return $this->HasMany(CompanyDocument::class);
    }
    public function companyCheck(string $companyId)
    {
        return $this->companies()->where('company_id', $companyId)->first();
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function pdf(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')->where('format', '=', 'pdf');
    }
}

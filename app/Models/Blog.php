<?php

namespace App\Models;

use App\Traits\ScopeBlogFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, ScopeBlogFilter, SoftDeletes;


    protected $fillable =[
        "status"
    ];

    public function languages(): HasMany
    {
        return $this->hasMany(BlogLanguage::class,'blog_id');
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
//            'blog_id' => [
//                'hasParam' => true,
//                'scopeMethod' => 'status'
//            ],
//            'language_id' => [
//                'hasParam' => true,
//                'scopeMethod' => 'nameLanguage'
//            ],
            'title' => [
                'hasParam' => true,
                'scopeMethod' => 'title'
            ],
            'description' => [
                'hasParam' => true,
                'scopeMethod' => 'description'
            ],
            'short_description' => [
                'hasParam' => true,
                'scopeMethod' => 'shortDescription'
            ],
            'content' => [
                'hasParam' => true,
                'scopeMethod' => 'content'
            ],
            'slug' => [
                'hasParam' => true,
                'scopeMethod' => 'slug'
            ],
            'city' => [
                'hasParam' => true,
                'scopeMethod' => 'city'
            ],
            'country' => [
                'hasParam' => true,
                'scopeMethod' => 'country'
            ],
            'status' => [
                'hasParam' => true,
                'scopeMethod' => 'status'
            ],
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
}

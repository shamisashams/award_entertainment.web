<?php

namespace App\Models;

use App\Traits\ScopeGalleryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use HasFactory, ScopeGalleryFilter, SoftDeletes;

    protected $fillable = [
        "status",
        "video_link"
    ];

    public function languages(): HasMany
    {
        return $this->hasMany(GalleryLanguage::class);
    }

    public function availableLanguage()
    {
        return $this->languages()->where('language_id', '=', app()->getLocale());
    }

    public function gallerySliders()
    {
        return $this->hasMany(GallerySlider::class);
    }


    public function getFilterScopes(): array
    {
        return [
            'id' => [
                'hasParam' => true,
                'scopeMethod' => 'id'
            ],
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

    public function slider(string $sliderId)
    {
        return $this->gallerySliders()->where('slider_id', $sliderId)->first();
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
        return $this->morphMany(File::class, 'fileable')->where(['type' => File::FILE_DEFAULT]);
    }

    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')->where(['type' => File::FILE_DEFAULT]);
    }

    public function mainFile(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')->where(['type' => File::FILE_MAIN]);
    }

//    public function allFiles()
//    {
//        return $this->morphMany(File::class, 'fileable');
//    }
}

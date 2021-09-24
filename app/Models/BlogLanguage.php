<?php

namespace App\Models;

use App\Traits\ScopeBlogFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogLanguage extends Model
{
    use HasFactory, ScopeBlogFilter;

    protected $fillable =[
        'language_id',
        "title",
        "description",
        "short_description",
        "content",
        "slug",
        "city",
        "country",
    ];

    public function getFilterScopes(): array
    {
        return [
            'id' => [
                'hasParam' => true,
                'scopeMethod' => 'id'
            ],
            'blog_id' => [
                'hasParam' => true,
                'scopeMethod' => 'blog_id'
            ],
            'language_id' => [
                'hasParam' => true,
                'scopeMethod' => 'language_id'
            ],
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
                'scopeMethod' => 'short_description'
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
        ];
    }

    /**
     * Begin querying the model.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function query()
    {
        return (new static)->newQuery();
    }
}

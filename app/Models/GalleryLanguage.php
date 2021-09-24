<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryLanguage extends Model
{
    use HasFactory;

    protected $fillable =[
        "gallery_id",
        "language_id",
        "title",
        "description",
        "short_description",
        "content",
        "content_2",
        "content_3",
        "slug",
    ];
}

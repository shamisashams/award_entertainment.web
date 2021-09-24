<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageLanguage extends Model
{
    use HasFactory;

    protected $fillable =[
        "page_id",
        "language_id",
        "title",
        "content_1",
        "content_2",
    ];
}

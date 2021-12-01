<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyLanguage extends Model
{
    use HasFactory;

    protected $fillable =[
        "company_id",
        "language_id",
        "description",
        "content_title",
        "content_description",
        "content_sub_title_1",
        "content_sub_title_2",
        "content_sub_title_3",
        "content_description_2",
        "content_description_3",
    ];}

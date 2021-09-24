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
    ];}

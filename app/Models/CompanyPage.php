<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPage extends Model
{
    use HasFactory;
    protected $table = "company_pages";
    protected $fillable =[
        "company_id",
        "page_id"
    ];
}

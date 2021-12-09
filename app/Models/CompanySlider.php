<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySlider extends Model
{
    use HasFactory;
    protected $table = "company_sliders";
    protected $fillable =[
        "company_id",
        "slider_id"
    ];
}

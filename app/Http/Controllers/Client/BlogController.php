<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Project;
use App\Models\Slider;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $blogs = Blog::latest()->with(["files", "availableLanguage"])->where("status",1)->paginate(8);
        return view('client.pages.blog.index', [
            "blogs" => $blogs,
        ]);
    }
}

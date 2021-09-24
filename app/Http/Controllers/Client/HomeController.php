<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Company;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $blogs = Blog::latest()->where("status", 1)->with(["files", "availableLanguage"])->take(6)->get();
        $galleries = Gallery::latest()->where("status", 1)->with(["files", "availableLanguage"])->take(12)->get();
        $sliders = Slider::latest()->where("type", Slider::HOME)->where("status", 1)->with("files")->get();
        $page = Page::with(["files", "availableLanguage"])->where("key", "home")->firstOrFail();
        $companies = Company::with(["files", "availableLanguage"])->where("status", 1)->get();

//        $settings = Setting::all();
        return view('client.pages.home.index', [
            "blogs" => $blogs,
            "galleries" => $galleries,
            "sliders" => $sliders,
            "page" => $page,
            "companies" => $companies
//            "settings" => $settings
        ]);
    }
}

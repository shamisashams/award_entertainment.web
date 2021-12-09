<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Company;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Project;
use App\Models\Slider;

class CompanyController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(string $locale, int $id)
    {
//        $blogs = Blog::latest()->where("status", 1)->with(["files", "availableLanguage"])->take(6)->get();
//        $galleries = Gallery::latest()->where("status", 1)->with(["files", "availableLanguage"])->take(12)->get();
//        $sliders = Slider::latest()->where("status", 1)->with("files")->get();
//        $page = Page::with(["files", "availableLanguage"])->where("key", "home")->firstOrFail();
        $company = Company::with(["files", "availableLanguage",
            "sliders" => function ($query) {
                $query->where("status", 1)->with("files");
            },
            "documents" => function ($query) {
                $query->with("availableLanguage")->where("status", 1);
            },
            "pages" => function($query){
                $query->with(["files", "availableLanguage"])->where("key", "home");
            }])->where("id", $id)->where("status", 1)->firstOrFail();
//        dd($company);
//        $settings = Setting::all();
        return view("client.pages.logo-page.index", [
//            "blogs" => $blogs,
//            "galleries" => $galleries,
//            "sliders" => $sliders,
//            "page" => $page,
            "company" => $company
//            "settings" => $settings
        ]);
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function about(string $locale, int $id)
    {
        $page = Page::with(["files", "availableLanguage", 'company'])
            ->where("key", "about")
            ->whereHas('company', function ($query) use ($id){
                $query->where('company_id', '=', $id);
            })->firstOrFail();
        return view('client.pages.about.index', [
            "page" => $page,
        ]);
    }
}

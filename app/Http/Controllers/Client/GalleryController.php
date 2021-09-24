<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\Gallery;
use App\Models\Project;
use App\Models\Slider;
use Illuminate\Http\Request;

class GalleryController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $galleries = Gallery::latest()->where("status", 1)->with(["files", "availableLanguage"])->paginate(5);
        return view('client.pages.gallery.index', [
            "galleries" => $galleries
        ]);
    }
    public function show(string $lang, int $id)
    {
        $companies = Company::with(["files", "availableLanguage"])->where("status", 1)->get();
        $gallery = Gallery::where("status", 1)->where("id", $id)->with(["files", "availableLanguage"])->firstOrFail();
        return view('client.pages.gallery.show', [
            "gallery" => $gallery,
            "companies" => $companies
        ]);
    }
}

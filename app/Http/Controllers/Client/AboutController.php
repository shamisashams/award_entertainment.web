<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Page;


class AboutController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $page = Page::with(["files", "availableLanguage"])->where("key", "about")->firstOrFail();
        return view('client.pages.about.index', [
            "page" => $page,
        ]);
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;
use App\Repositories\PageRepositoryInterface;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $pageRepository;

    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function index(Request $request)
    {
        return view('admin.pages.page.index', [
            "pages" => $this->pageRepository->getData($request, ["languages"]),
            'languages' => $this->activeLanguages()
        ]);
    }

    public function edit(string $locale, int $id)
    {
        $page = $this->pageRepository->findORFail($id);
        $url = locale_route('page.update', $page->id, false);
        $method = 'PUT';
        return view('admin.pages.page.form', [
            'page' => $page,
            'url' => $url,
            'method' => $method,
            "languages"=>$this->activeLanguages()
        ]);
    }

    public function update(string $lang, int $id, PageRequest $request)
    {
        $data = [
            'title' => $request['title'],
            'content_1' => $request['content_1'],
            'content_2' => $request['content_2'],
            'languages' => $this->activeLanguages(),
        ];
        $page = $this->pageRepository->update($id, $data);

        // Update Files
        $this->pageRepository->saveFiles($id, $request);

        return redirect(locale_route('page.show', $page->id))->with('success', 'Page updated.');

    }
    public function show(string $lang, int $id)
    {
        $page = $this->pageRepository->findOrFail($id);

        return view("admin.pages.page.show", [
            "page" => $page,
            "languages"=>$this->activeLanguages()
        ]);

    }
}

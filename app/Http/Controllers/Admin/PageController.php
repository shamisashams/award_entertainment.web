<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Company;
use App\Repositories\PageRepositoryInterface;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $pageRepository;

    /**
     * @param PageRepositoryInterface $pageRepository
     */
    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $firstTwoRecordsId = array_column($this->pageRepository->getFirstTworecordsId($request)->toArray(), 'id');
        return view('admin.pages.page.index', [
            "pages" => $this->pageRepository->getData($request, ["languages"]),
            "firstTwoRecordsId" => $firstTwoRecordsId,
            'languages' => $this->activeLanguages()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $page = $this->pageRepository->model;
        $url = locale_route('page.store', [], false);
        $method = 'POST';
        $firstTwoRecordsId = array_column($this->pageRepository->getFirstTworecordsId()->toArray(), 'id');

        return view('admin.pages.page.form', [
            'page' => $page,
            'url' => $url,
            'method' => $method,
            "languages"=>$this->activeLanguages(),
            'companies' => Company::where("status", 1)->get(),
            "firstTwoRecordsId" => $firstTwoRecordsId,
            "selectedCompanies" => [],
        ]);
    }

    /**
     * @param PageRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \ReflectionException
     */
    public function store(PageRequest $request)
    {
        $data = [
            'title' => $request['title'],
            'content_1' => $request['content_1'],
            'content_2' => $request['content_2'],
            'key' => $request['key'],
            'languages' => $this->activeLanguages(),
            'companies' => $request['companies']

        ];
        $company = $this->pageRepository->create($data);

        // Save Files
        if ($request->hasFile('images')) {
            $company = $this->pageRepository->saveFiles($company->id, $request);
        }

        return redirect(locale_route('page.show', $company->id))->with('success', 'Page created.');
    }


    /**
     * @param string $locale
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(string $locale, int $id)
    {
        $page = $this->pageRepository->findORFail($id);
        $url = locale_route('page.update', $page->id, false);
        $method = 'PUT';
        $selectedCompanies = $page->company;
        $firstTwoRecordsId = array_column($this->pageRepository->getFirstTworecordsId()->toArray(), 'id');


        return view('admin.pages.page.form', [
            'page' => $page,
            'url' => $url,
            'method' => $method,
            "languages"=>$this->activeLanguages(),
            'companies' => Company::where("status", 1)->get(),
            "firstTwoRecordsId" => $firstTwoRecordsId,

            "selectedCompanies" => array_column($selectedCompanies->toArray(), "id"),

        ]);
    }

    /**
     * @param string $lang
     * @param int $id
     * @param PageRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \ReflectionException
     */
    public function update(string $lang, int $id, PageRequest $request)
    {
        $data = [
            'title' => $request['title'],
            'content_1' => $request['content_1'],
            'content_2' => $request['content_2'],
            'key' => $request['key'],
            'languages' => $this->activeLanguages(),
            'companies' => $request['companies']

        ];
        $page = $this->pageRepository->update($id, $data);

        // Update Files
        $this->pageRepository->saveFiles($id, $request);

        return redirect(locale_route('page.show', $page->id))->with('success', 'Page updated.');

    }

    /**
     * @param string $lang
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(string $lang, int $id)
    {
        $page = $this->pageRepository->findOrFail($id);

        return view("admin.pages.page.show", [
            "page" => $page,
            "languages"=>$this->activeLanguages()
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $locale
     * @param int $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(string $locale, int $id)
    {
        if (!$this->pageRepository->delete($id)) {
            return redirect(locale_route('page.show', $id))->with('danger', 'Page not deleted.');
        }
        return redirect(locale_route('page.index'))->with('success', 'Page Deleted.');
    }
}

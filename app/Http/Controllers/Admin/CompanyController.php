<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogRequest;
use App\Http\Requests\Admin\CompanyRequest;
use App\Repositories\BlogRepositoryInterface;
use App\Repositories\CompanyRepositoryInterface;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    protected $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function index(Request $request)
    {
        return view('admin.pages.company.index', [
            "companies" => $this->companyRepository->getData($request, ["languages"]),
            'languages' => $this->activeLanguages()
        ]);
    }



    public function create()
    {
        $company = $this->companyRepository->model;
//        dd($blog);
        $url = locale_route('company.store', [], false);
        $method = 'POST';
        return view('admin.pages.company.form', [
            'company' => $company,
            'url' => $url,
            'method' => $method,
            "languages"=>$this->activeLanguages()

        ]);
    }

    public function show(string $lang, int $id)
    {
        $company = $this->companyRepository->findOrFail($id);

        return view("admin.pages.company.show", [
            "company" => $company,
            "languages"=>$this->activeLanguages()
        ]);

    }

    public function edit(string $locale, int $id)
    {
        $company = $this->companyRepository->findORFail($id);
        $url = locale_route('company.update', $company->id, false);
        $method = 'PUT';
        return view('admin.pages.company.form', [
            'company' => $company,
            'url' => $url,
            'method' => $method,
            "languages"=>$this->activeLanguages()
        ]);
    }

    public function store(CompanyRequest $request)
    {
        $data = [
            'status' => (bool)$request['status'],
            'company_link' => $request['company_link'],
            'languages' => $this->activeLanguages(),
            'description' => $request['description'],
            'content_title' => $request['content_title'],
            'content_sub_title_1' => $request['content_sub_title_1'],
            'content_sub_title_2' => $request['content_sub_title_2'],
            'content_sub_title_3' => $request['content_sub_title_3'],
            'content_description' => $request['content_description'],
            'content_description_2' => $request['content_description_2'],
            'content_description_3' => $request['content_description_3'],
            'country' => $request['country'],
            'address' => $request['address'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'facebook' => $request['facebook'],
            'linkedin' => $request['linkedin'],
        ];
        $company = $this->companyRepository->create($data);

        // Save Files
        if ($request->hasFile('images')|| $request->hasFile('main-image')) {
            $company = $this->companyRepository->saveFile($company->id, $request);
        }

        return redirect(locale_route('company.show', $company->id))->with('success', 'Company created.');
    }

    public function update(string $lang, int $id, CompanyRequest $request)
    {
        $data = [
            'status' => (bool)$request['status'],
            'company_link' => $request['company_link'],
            'description' => $request['description'],
            'content_title' => $request['content_title'],
            'content_sub_title_1' => $request['content_sub_title_1'],
            'content_sub_title_2' => $request['content_sub_title_2'],
            'content_sub_title_3' => $request['content_sub_title_3'],
            'content_description' => $request['content_description'],
            'content_description_2' => $request['content_description_2'],
            'content_description_3' => $request['content_description_3'],
            'country' => $request['country'],
            'address' => $request['address'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'facebook' => $request['facebook'],
            'linkedin' => $request['linkedin'],
            'languages' => $this->activeLanguages(),
        ];
        $company = $this->companyRepository->update($id, $data);

        // Update Files
        $this->companyRepository->saveFile($id, $request);


        return redirect(locale_route('company.show', $company->id))->with('success', 'Company updated.');

    }

    public function destroy(string $lang, int $id)
    {
        if (!$this->companyRepository->delete($id)) {
            return redirect(locale_route('company.show', $id))->with('danger', 'Company not deleted.');
        }

        return redirect(locale_route('company.index'))->with('success', 'Company Deleted.');

    }
}

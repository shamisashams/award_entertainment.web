<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogRequest;
use App\Http\Requests\Admin\CompanyRequest;
use App\Http\Requests\Admin\DocumentRequest;
use App\Models\Company;
use App\Models\CompanyDocument;
use App\Models\DocumentLanguage;
use App\Models\File;
use App\Repositories\BlogRepositoryInterface;
use App\Repositories\CompanyRepositoryInterface;
use App\Repositories\DocumentRepositoryInterface;
use Illuminate\Http\Request;

class DocumentController extends Controller
{

    protected $documentRepository;

    public function __construct(DocumentRepositoryInterface $documentRepository)
    {
        $this->documentRepository = $documentRepository;
    }

    public function index(Request $request)
    {
        return view('admin.pages.document.index', [
            "documents" => $this->documentRepository->getData($request, ["languages"]),
            'languages' => $this->activeLanguages()
        ]);
    }



    public function create()
    {

        $document = $this->documentRepository->model;
        $url = locale_route('document.store', [], false);
        $method = 'POST';
        $companies = Company::with(["availableLanguage"])->where("status", 1)->get();
        return view('admin.pages.document.form', [
            'document' => $document,
            'companies' => Company::where("status", 1)->get(),
            "selectedCompanies" => [],
            'url' => $url,
            'method' => $method,
            "languages"=>$this->activeLanguages()
        ]);
    }

    public function show(string $lang, int $id)
    {
        $document = $this->documentRepository->findOrFail($id);

        return view("admin.pages.document.show", [
            "document" => $document,
            "languages"=>$this->activeLanguages()
        ]);

    }

    public function edit(string $locale, int $id)
    {
        $document = $this->documentRepository->findORFail($id);
        $selectedCompanies = $document->company;
//        dd($selectedCompanies->toArray());
        $companies = Company::with(["availableLanguage"])->where("status", 1)->get();

        $url = locale_route('document.update', $document->id, false);
        $method = 'PUT';
        return view('admin.pages.document.form', [
            'document' => $document,
            'url' => $url,
            'companies' => Company::where("status", 1)->get(),
            "sliders" => Company::where("status", 1)->get(),
            "selectedCompanies" => array_column($selectedCompanies->toArray(), "id"),
            'method' => $method,
            "languages"=>$this->activeLanguages()
        ]);
    }

    public function store(DocumentRequest $request)
    {
        $data = [
            'status' => (bool)$request['status'],
//            'link' => $request['link'],
            'languages' => $this->activeLanguages(),
            'title' => $request['title'],
            'companies' => $request['companies']
        ];
        $document = $this->documentRepository->create($data);

        if ($request->hasFile('pdf')) {
            $filename = date('Ymhs') . str_replace(' ', '', $request->file('pdf')->getClientOriginalName());
            $destination = base_path() . '/storage/app/public/Document/' . $document->id;
            $request->file('pdf')->move($destination, $filename);
            $document->pdf()->create([
                'title' => $filename,
                'path' => 'storage/Document/' . $document->id,
                'format' => $request->file('pdf')->getClientOriginalExtension(),
                'type' => File::FILE_DEFAULT
            ]);
        }

        return redirect(locale_route('document.show', $document->id))->with('success', 'Document created.');
    }

    public function update(string $lang, int $id, DocumentRequest $request)
    {
        $data = [
            'status' => (bool)$request['status'],
//            'link' => $request['link'],
            'languages' => $this->activeLanguages(),
            'title' => $request['title'],
            'companies' => $request["companies"]
        ];
        $document = $this->documentRepository->update($id, $data, $request["companies"]);

        // Update Files
//        $this->documentRepository->saveFile($id, $request);
        if ($request->hasFile('pdf')) {
            if ($document->pdf()) {
                $document->pdf()->delete();
            }
            $filename = date('Ymhs') . str_replace(' ', '', $request->file('pdf')->getClientOriginalName());
            $destination = base_path() . '/storage/app/public/Document/' . $document->id;
            $request->file('pdf')->move($destination, $filename);
            $document->pdf()->create([
                'title' => $filename,
                'path' => 'storage/Document/' . $document->id,
                'format' => $request->file('pdf')->getClientOriginalExtension(),
                'type' => File::FILE_DEFAULT
            ]);
        }


        return redirect(locale_route('document.show', $document->id))->with('success', 'Document updated.');

    }

    public function destroy(string $lang, int $id)
    {

        if (!$this->documentRepository->delete($id)) {
            return redirect(locale_route('document.show', $id))->with('danger', 'Document not deleted.');
        }

        return redirect(locale_route('document.index'))->with('success', 'Document Deleted.');

    }
}

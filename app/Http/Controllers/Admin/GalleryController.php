<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryRequest;
use App\Models\Slider;
use App\Repositories\GalleryRepositoryInterface;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    protected $galleryRepository;

    public function __construct(GalleryRepositoryInterface $galleryRepository)
    {
        $this->galleryRepository = $galleryRepository;
    }

    public function index(GalleryRequest $request)
    {

        return view('admin.pages.gallery.index', [
            "galleries" => $this->galleryRepository->getData($request, ["languages"]) ,
            'languages' => $this->activeLanguages()
        ]);
    }

    public function create()
    {
        $gallery = $this->galleryRepository->model;
        $sliders = Slider::with("languages")->where("status", 1)->get();
        $url = locale_route('gallery.store', [], false);
        $method = 'POST';
        return view('admin.pages.gallery.form', [
            'gallery' => $gallery,
            'sliders' =>$sliders,
            "gallerySliders" => [],
            'url' => $url,
            'method' => $method,
            "languages"=>$this->activeLanguages()

        ]);
    }
    public function store(GalleryRequest $request)
    {
        $data = [
            'status' => (bool)$request['status'],
            'video_link' => $request['url'],
            'slider_id' => $request['slider_id'],
            'title' => $request['title'],
            'description' => $request['description'],
            'languages' => $this->activeLanguages(),
            "shortDescription" => $request["short-description"],
            "content" => $request["content"],
            "content_2" => $request["content_2"],
            "content_3" => $request["content_3"],
            "slug" => $request["slug"],
        ];
        $gallery = $this->galleryRepository->create($data);

        // Save Files
        if ($request->hasFile('images')) {
            $gallery = $this->galleryRepository->saveFiles($gallery->id, $request);
        }

        return redirect(locale_route('gallery.index', $gallery->id))->with('success', 'Gallery created.');
    }
    public function edit(string $locale, int $id)
    {
        $gallery = $this->galleryRepository->findORFail($id);
        $gallerySliders=$gallery->gallerySliders;
        $sliders = Slider::with("languages")->where("status", 1)->get();
        $url = locale_route('gallery.update', $gallery->id, false);
        $method = 'PUT';
        return view('admin.pages.gallery.form', [
            'gallery' => $gallery,
            "sliders" => $sliders,
            "gallerySliders" => array_column($gallerySliders->toArray(), "slider_id"),
            'url' => $url,
            'method' => $method,
            "languages"=>$this->activeLanguages()
        ]);
    }
    public function update(string $lang, int $id, GalleryRequest $request)
    {
        $data = [
            'status' => (bool)$request['status'],
            'video_link' => $request['url'],
            'slider_id' => $request['slider_id'],
            'title' => $request['title'],
            'description' => $request['description'],
            'languages' => $this->activeLanguages(),
            "shortDescription" => $request["short-description"],
            "content" => $request["content"],
            "content_2" => $request["content_2"],
            "content_3" => $request["content_3"],
            "slug" => $request["slug"],
        ];
        $gallery = $this->galleryRepository->update($id, $data);

        // Update Files
        $this->galleryRepository->saveFiles($id, $request);

        return redirect(locale_route('gallery.show', $gallery->id))->with('success', 'Gallery updated.');

    }
    public function show(string $lang, int $id)
    {
        $gallery = $this->galleryRepository->findOrFail($id);
        return view("admin.pages.gallery.show", [
            "gallery" => $gallery,
            "languages"=>$this->activeLanguages()
        ]);

    }

    public function destroy(string $lang, int $id)
    {
        if (!$this->galleryRepository->delete($id)) {
            return redirect(locale_route('gallery.show', $id))->with('danger', 'gallery not deleted.');
        }

        return redirect(locale_route('gallery.index'))->with('success', 'gallery Deleted.');

    }
}

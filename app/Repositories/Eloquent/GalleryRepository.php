<?php

namespace App\Repositories\Eloquent;

use App\Http\Request\Admin\BlogRequest;
use App\Http\Request\Admin\ProductRequest;
use App\Http\Requests\Admin\GalleryRequest;
use App\Models\File;
use App\Models\Gallery;
use App\Models\ProductAnswers;
use App\Models\ProductLanguage;
use App\Repositories\GalleryRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\Eloquent\Base\BaseRepository;

use Illuminate\Support\Facades\DB;


class GalleryRepository extends BaseRepository implements GalleryRepositoryInterface
{

//    use ScopeFilter;

    public function __construct(Gallery $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes = []): Gallery
    {
        try {
            DB::connection()->beginTransaction();

            $dataGallery = [
                'status' => $attributes['status'],
                "video_link" => $attributes["video_link"]
            ];
            $this->model = parent::create($dataGallery);

            if ($attributes["slider_id"]) {
                foreach ($attributes["slider_id"] as $slider) {
                    $dataGallerySlider [] = [
                        "slider_id" => $slider,
                        "gallery_id" => $this->model->id
                    ];
                }
                $this->model->gallerySliders()->createMany($dataGallerySlider);
            }


            foreach ($attributes['languages'] as $language) {
                $galleryLanguages [] = [
                    'language_id' => $language['id'],
                    'title' => $attributes['title'][$language['id']],
                    'description' => $attributes['description'][$language['id']],
                    'short_description' => $attributes['shortDescription'][$language['id']],
                    'content' => $attributes['content'][$language['id']],
                    'slug' => $attributes['slug'][$language['id']],
                ];
            }
            $this->model->languages()->createMany($galleryLanguages);


            DB::connection()->commit();

            return $this->model;
        } catch (\PDOException $e) {
            DB::connection()->rollBack();
        }
    }

    public function update(int $id, array $data = []): Gallery
    {
        try {
            DB::connection()->beginTransaction();

            $galleryAttributes = [
                'status' => $data['status'],
                "video_link" => $data["video_link"]
            ];
            $this->model = parent::update($id, $galleryAttributes);

//            dd($data["slider_id"]);
            if ($data["slider_id"]) {
                $oldSliders = array_column($this->model->gallerySliders()->get()->toArray(), "slider_id");
                foreach ($data["slider_id"] as $slider) {
                    if (($key = array_search($slider, $oldSliders)) !== false) {
                        unset($oldSliders[$key]);
                    }


                    if (!$this->model->slider($slider)) {
                        $this->model->gallerySliders()->create([
                            "slider_id" => $slider,
                            "gallery_id" => $this->model->id
                        ]);
                    }
                }
                $this->model->gallerySliders()->whereIn("slider_id",$oldSliders)->delete();
            }else{
                $this->model->gallerySliders()->delete();
            }
//            $this->model->gallerySliders()->createMany($dataGallerySlider);


            foreach ($data['languages'] as $language) {
                if (null !== $this->model->language($language['id'])) {
                    $this->model->language($language['id'])->update([
                        'title' => $data['title'][$language['id']],
                        'description' => $data['description'][$language['id']],
                        'short_description' => $data['shortDescription'][$language['id']],
                        'content' => $data['content'][$language['id']],
                        'slug' => $data['slug'][$language['id']],
                    ]);
                }else{
                    $this->model->languages()->create([
                        'language_id' => $language['id'],
                        'title' => $data['title'][$language['id']],
                        'description' => $data['description'][$language['id']],
                        'short_description' => $data['shortDescription'][$language['id']],
                        'content' => $data['content'][$language['id']],
                        'slug' => $data['slug'][$language['id']],
                    ]);
                }
            }

            DB::connection()->commit();

            return $this->model;
        } catch (\PDOException $e) {
            DB::connection()->rollBack();
        }
    }


    public function saveFile(int $id, GalleryRequest $request): Gallery
    {

        $this->model = $this->findOrFail($id);

        // Delete old files if exist
        if (count($this->model->files)) {
            foreach ($this->model->files as $file) {
                if (!$request->old_images) {
                    $file->delete();
                    continue;
                }
                if (!in_array((string)$file->id, $request->old_images, true)) {
                    $file->delete();
                }
            }
        }

        $oldMain = json_decode($request->old_main_image);
        if (!$oldMain && $this->model->mainFile) {
            $this->model->mainFile->delete();
        }


        if ($request->hasFile('main-image')) {
            // Get Name Of model
            $image = $request->file('main-image');
            $imagename = date('Ymhs') . str_replace(' ', '', $image->getClientOriginalName());
            $destination = base_path() . '/storage/app/public/' . 'Gallery' . '/' . $this->model->id;
            $image->move($destination, $imagename);
            $this->model->files()->create([
                'title' => $imagename,
                'path' => 'storage/' . 'Gallery' . '/' . $this->model->id,
                'format' => $image->getClientOriginalExtension(),
                'type' => File::FILE_MAIN
            ]);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $file) {
                $imagename = date('Ymhs') . str_replace(' ', '', $file->getClientOriginalName());
                $destination = base_path() . '/storage/app/public/' . 'Gallery' . '/' . $this->model->id;
                $request->file('images')[$key]->move($destination, $imagename);
                $this->model->files()->create([
                    'title' => $imagename,
                    'path' => 'storage/' . 'Gallery' . '/' . $this->model->id,
                    'format' => $file->getClientOriginalExtension(),
                    'type' => File::FILE_DEFAULT
                ]);
            }
        }


        return $this->model;
    }

}

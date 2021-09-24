<?php

namespace App\Repositories\Eloquent;

use App\Http\Request\Admin\BlogRequest;
use App\Http\Request\Admin\ProductRequest;
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
                    'content_2' => $attributes['content_2'][$language['id']],
                    'content_3' => $attributes['content_3'][$language['id']],
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
                        'content_2' => $data['content_2'][$language['id']],
                        'content_3' => $data['content_3'][$language['id']],
                        'slug' => $data['slug'][$language['id']],
                    ]);
                }else{
                    $this->model->languages()->create([
                        'language_id' => $language['id'],
                        'title' => $data['title'][$language['id']],
                        'description' => $data['description'][$language['id']],
                        'short_description' => $data['shortDescription'][$language['id']],
                        'content' => $data['content'][$language['id']],
                        'content_2' => $data['content_2'][$language['id']],
                        'content_3' => $data['content_3'][$language['id']],
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


}

<?php

namespace App\Repositories\Eloquent;

use App\Http\Request\Admin\BlogRequest;
use App\Http\Request\Admin\ProductRequest;
use App\Models\Blog;
use App\Models\ProductAnswers;
use App\Models\ProductLanguage;
use App\Repositories\BlogRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\Eloquent\Base\BaseRepository;

use Illuminate\Support\Facades\DB;


class BlogRepository extends BaseRepository implements BlogRepositoryInterface
{

//    use ScopeFilter;

    public function __construct(Blog $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes = []) :Blog
    {
        try {
            DB::connection()->beginTransaction();

            $data = [
                'status' => $attributes['status']
            ];
            $this->model = parent::create($data);

            $blogLanguages = [];

            foreach ($attributes['languages'] as $language) {
                $blogLanguages [] = [
                    'language_id' => $language['id'],
                    'title' => $attributes['title'][$language['id']],
                    'description' => $attributes['description'][$language['id']],
                    'short_description' => $attributes['shortDescription'][$language['id']],
                    'content' => $attributes['content'][$language['id']],
                    'slug' => $attributes['slug'][$language['id']],
                    'city' => $attributes['city'][$language['id']],
                    'country' => $attributes['country'][$language['id']],


                ];
            }

            $this->model->languages()->createMany($blogLanguages);

            DB::connection()->commit();

            return $this->model;
        } catch (\PDOException $e) {
            DB::connection()->rollBack();
        }
    }

    public function update(int $id, array $data = []): Blog
    {
        try {
            DB::connection()->beginTransaction();

            $attributes = [
                'status' => $data['status']
            ];

            $this->model = parent::update($id, $attributes);
            foreach ($data['languages'] as $language) {
                if (null !== $this->model->language($language['id'])) {
                    $this->model->language($language['id'])->update([
                        'title' => $data['title'][$language['id']],
                        'description' => $data['description'][$language['id']],
                        'short_description' => $data['shortDescription'][$language['id']],
                        'content' => $data['content'][$language['id']],
                        'slug' => $data['slug'][$language['id']],
                        'city' => $data['city'][$language['id']],
                        'country' => $data['country'][$language['id']],
                    ]);
                }else{
                    $this->model->languages()->create([
                        'language_id' => $language['id'],
                        'title' => $data['title'][$language['id']],
                        'description' => $data['description'][$language['id']],
                        'short_description' => $data['shortDescription'][$language['id']],
                        'content' => $data['content'][$language['id']],
                        'slug' => $data['slug'][$language['id']],
                        'city' => $data['city'][$language['id']],
                        'country' => $data['country'][$language['id']],
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

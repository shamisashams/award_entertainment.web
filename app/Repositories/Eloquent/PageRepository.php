<?php

namespace App\Repositories\Eloquent;

use App\Models\Page;
use App\Repositories\PageRepositoryInterface;
use App\Repositories\Eloquent\Base\BaseRepository;
use Illuminate\Support\Facades\DB;


class PageRepository extends BaseRepository implements PageRepositoryInterface
{

//    use ScopeFilter;

    public function __construct(Page $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes = []) :Page
    {
        try {
            DB::connection()->beginTransaction();

            $data = [
//                'status' => $attributes['status'],
                'key' => $attributes['key']
            ];
            $this->model = parent::create($data);

            $pageLanguages = [];
//            dd($attributes);

            foreach ($attributes['languages'] as $language) {
                $pageLanguages [] = [
                    'language_id' => $language['id'],
                    'title' => $attributes['title'][$language['id']],
                    'content_1' => $attributes['content_1'][$language['id']],
                    'content_2' => $attributes['content_2'][$language['id']],

                ];
            }

            $this->model->languages()->createMany($pageLanguages);
            $this->model->company()->attach($attributes['companies']);



            DB::connection()->commit();

            return $this->model;
        } catch (\PDOException $e) {
            DB::connection()->rollBack();
        }
    }

    public function update(int $id, array $data = []): Page
    {
        try {
            DB::connection()->beginTransaction();

            $attributes = [
//                'status' => $data['status'],
                'key' => $data['key']

            ];

            $this->model = parent::update($id, $attributes);
            foreach ($data['languages'] as $language) {
                if (null !== $this->model->language($language['id'])) {
                    $this->model->language($language['id'])->update([
                        'title' => $data['title'][$language['id']],
                        'content_1' => $data['content_1'][$language['id']],
                        'content_2' => $data['content_2'][$language['id']],
                    ]);
                }else{
                    $this->model->languages()->create([
                        'language_id' => $language['id'],
                        'title' => $data['title'][$language['id']],
                        'content_1' => $data['content_1'][$language['id']],
                        'content_2' => $data['content_2'][$language['id']],
                    ]);
                }
            }
            // Remove all companies
            $this->model->company()->detach();
            // Add new companies
            $this->model->company()->attach($data['companies']);


            DB::connection()->commit();

            return $this->model;
        } catch (\PDOException $e) {
            DB::connection()->rollBack();
        }
    }

//    finding first two records id which can't be deleted
    public function getFirstTworecordsId()
    {
        $data = $this->model->take(2)->select('id')->get();


        return $data;
    }


}

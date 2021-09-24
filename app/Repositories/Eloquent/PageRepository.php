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
//                'status' => $attributes['status']
            ];
            $this->model = parent::create($data);

            $pageLanguages = [];

            foreach ($attributes['languages'] as $language) {
                $pageLanguages [] = [
                    'language_id' => $language['id'],
                    'title' => $attributes['title'][$language['id']],
                    '$content_1' => $attributes['$content_1'][$language['id']],
                    '$content_2' => $attributes['$content_2'][$language['id']],

                ];
            }

            $this->model->languages()->createMany($pageLanguages);

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
//                'status' => $data['status']
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

            DB::connection()->commit();

            return $this->model;
        } catch (\PDOException $e) {
            DB::connection()->rollBack();
        }
    }


}

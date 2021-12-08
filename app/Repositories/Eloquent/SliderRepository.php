<?php
/**
 *  app/Repositories/Eloquent/SliderRepository.php
 *
 * Date-Time: 14.06.21
 * Time: 15:26
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Repositories\Eloquent;


use App\Models\Project;
use App\Models\Slider;
use App\Repositories\Eloquent\Base\BaseRepository;
use App\Repositories\SliderRepositoryInterface;
use Illuminate\Support\Facades\DB;

/**
 * Class SliderRepository
 * @package App\Repositories\Eloquent
 */
class SliderRepository extends BaseRepository implements SliderRepositoryInterface
{
    /**
     * SliderRepository constructor.
     *
     * @param \App\Models\Slider $model
     */
    public function __construct(Slider $model)
    {
        parent::__construct($model);
    }


    /**
     * @param array $attributes
     * @return Slider
     */
    public function create(array $attributes = []): Slider
    {
        try {
            DB::connection()->beginTransaction();

            $data = [
                'status' => $attributes['status'],
                'url' => $attributes['url'],
                "type" => $attributes["type"]
            ];

            $this->model = parent::create($data);

            $sliderLanguages = [];

            foreach ($attributes['languages'] as $language) {
                $sliderLanguages [] = [
                    'language_id' => $language['id'],
                    'title' => $attributes['title'][$language['id']],
                    'description' => $attributes['description'][$language['id']],
                ];
            }

            $this->model->languages()->createMany($sliderLanguages);
            $this->model->company()->attach($attributes['companies']);


            DB::connection()->commit();

            return $this->model;
        } catch (\PDOException $e) {
            DB::connection()->rollBack();
        }
    }


    /**
     * @param int $id
     * @param array $data
     * @return Slider
     */
    public function update(int $id, array $data = []): Slider
    {
        try {
            DB::connection()->beginTransaction();

            $attributes = [
                'status' => $data['status'],
                'url' => $data['url'],
                "type" => $data["type"]
            ];

            $this->model = parent::update($id, $attributes);
            foreach ($data['languages'] as $language) {
                if (null !== $this->model->language($language['id'])) {
                    $this->model->language($language['id'])->update([
                        'title' => $data['title'][$language['id']],
                        'description' => $data['description'][$language['id']],
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
}

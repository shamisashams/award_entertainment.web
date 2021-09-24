<?php
/**
 *  app/Repositories/Eloquent/CityRepository.php
 *
 * Date-Time: 09.06.21
 * Time: 14:48
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Repositories\Eloquent;


use App\Models\Answer;
use App\Models\City;
use App\Models\Feature;
use App\Models\Setting;
use App\Repositories\CityRepositoryInterface;
use App\Repositories\Eloquent\Base\BaseRepository;
use App\Repositories\SettingRepositoryInterface;
use Illuminate\Support\Facades\DB;

/**
 * Class CityRepository
 * @package App\Repositories\Eloquent
 */
class SettingRepository extends BaseRepository implements SettingRepositoryInterface
{
    /**
     * AnswerRepository constructor.
     *
     * @param \App\Models\City $model
     */
    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }

    /**
     * Create new model
     *
     * @param int $id
     * @param array $data
     *
     * @return \App\Models\City
     */
    public function update(int $id, array $data = [])
    {
        try {
            DB::connection()->beginTransaction();

            $this->model = parent::findOrFail($id);

            foreach ($data['languages'] as $language) {
                if (null !== $this->model->language($language['id'])) {
                    $this->model->language($language['id'])->update([
                        'value' => $data['value'][$language['id']],
                    ]);
                } else if(isset($data['value'][$language['id']])){
                    $this->model->languages()->create([
                        'language_id' => $language['id'],
                        'value' => $data['value'][$language['id']],
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
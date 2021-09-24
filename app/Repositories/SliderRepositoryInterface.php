<?php
/**
 *  app/Repositories/SliderRepositoryInterface.php
 *
 * Date-Time: 14.06.21
 * Time: 15:28
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Repositories;


use App\Http\Requests\Admin\ProjectRequest;
use App\Http\Requests\Admin\SliderRequest;
use App\Models\Slider;

/**
 * Interface SliderRepositoryInterface
 * @package App\Repositories
 */
interface SliderRepositoryInterface
{

    /**
     * @param \App\Http\Requests\Admin\ProjectRequest $request
     * @param array $with
     */
    public function getData(ProjectRequest $request, array $with = []);

    /**
     * @param array $attributes
     *
     * @return \App\Models\Slider
     */
    public function create(array $attributes): Slider;

    /**
     * Update model by the given ID
     *
     * @param integer $id
     * @param array $data
     *
     * @return \App\Models\Slider
     */
    public function update(int $id, array $data = []): Slider;

    /**
     * @param int $id
     * @param \App\Http\Requests\Admin\SliderRequest $request
     *
     * @return \App\Models\Slider
     */
    public function saveFiles(int $id,SliderRequest $request);
}
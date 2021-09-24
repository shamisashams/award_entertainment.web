<?php
/**
 *  app/Repositories/CityRepositoryInterface.php
 *
 * Date-Time: 09.06.21
 * Time: 14:46
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Repositories;


use App\Http\Requests\Admin\CityRequest;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\City;

/**
 * Interface CityRepositoryInterface
 * @package App\Repositories
 */
interface SettingRepositoryInterface
{

    /**
     * @param \App\Http\Requests\Admin\CityRequest $request
     * @param array $with
     */
    public function getData(SettingRequest $request, array $with = []);

}
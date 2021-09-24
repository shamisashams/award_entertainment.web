<?php
/**
 *  app/Http/Controllers/Admin/CityController.php
 *
 * Date-Time: 09.06.21
 * Time: 14:44
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CityRequest;
use App\Http\Requests\Admin\SettingRequest;
use App\Repositories\CityRepositoryInterface;
use App\Repositories\SettingRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class CityController
 * @package App\Http\Controllers\Admin
 */
class SettingController extends Controller
{
    /**
     * @var \App\Repositories\SettingRepositoryInterface
     */
    private $settingRepository;


    /**
     * CityController constructor.
     *
     * @param \App\Repositories\CityRepositoryInterface $cityRepository
     */
    public function __construct(SettingRepositoryInterface $settingRepository) {
        $this->settingRepository = $settingRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(SettingRequest $request)
    {
        return view('admin.pages.setting.index', [
            'settings' => $this->settingRepository->getData($request),
            'languages' => $this->activeLanguages()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Admin\CityRequest $request
     *
     * @return void
     */
    public function store(CityRequest $request)
    {

    }

    /**
     *
     * Display the specified resource.
     *
     * @param string $locale
     * @param int $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(string $locale, int $id)
    {
        $setting = $this->settingRepository->findOrFail($id);

        return view('admin.pages.setting.show',[
            'setting' => $setting,
            'languages' => $this->activeLanguages()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $locale
     * @param int $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(string $locale, int $id)
    {
        $setting = $this->settingRepository->findOrfail($id);

        $url = locale_route('setting.update', $id, false);

        $method = 'PUT';

        return view('admin.pages.setting.form', [
            'setting' => $setting,
            'url' => $url,
            'method' => $method,
            'languages' => $this->activeLanguages(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param string $locale
     * @param int $id
     *
     * @param \App\Http\Requests\Admin\CityRequest $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(string $locale,int $id,SettingRequest $request)
    {
        $data = [
            'value' => $request['value'],
            'languages' => $this->activeLanguages(),
        ];

        $setting = $this->settingRepository->update($id,$data);

        return redirect(locale_route('setting.show', $setting->id))->with('success', 'Setting updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $locale
     * @param int $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(string $locale, int $id)
    {

    }
}

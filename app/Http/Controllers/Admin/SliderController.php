<?php
/**
 *  app/Http/Controllers/Admin/SliderController.php
 *
 * Date-Time: 14.06.21
 * Time: 15:31
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderRequest;
use App\Repositories\SliderRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class SliderController
 * @package App\Http\Controllers\Admin
 */
class SliderController extends Controller
{

    /**
     * @var \App\Repositories\SliderRepositoryInterface
     */
    private $sliderRepository;

    /**
     * SliderController constructor.
     *
     * @param \App\Repositories\SliderRepositoryInterface $sliderRepository
     */
    public function __construct(SliderRepositoryInterface $sliderRepository)
    {
        $this->sliderRepository = $sliderRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(SliderRequest $request)
    {
        return view('admin.pages.slider.index', [
            'sliders' => $this->sliderRepository->getData($request, ['languages']),
            'languages' => $this->activeLanguages()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $slider = $this->sliderRepository->model;
        $type = "homepage";
        $url = locale_route('slider.store', [], false);
        $method = 'POST';

        return view('admin.pages.slider.form', [
            'slider' => $slider,
            'url' => $url,
            "type" => $type,
            'method' => $method,
            'languages' => $this->activeLanguages(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Admin\SliderRequest $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(SliderRequest $request)
    {
        $data = [
            'url' => $request['url'],
            "type" => $request["type"],
            'status' => (bool)$request['status'],
            'title' => $request['title'],
            'description' => $request['description'],
            'languages' => $this->activeLanguages(),
        ];

        $slider = $this->sliderRepository->create($data);

        // Save Files
        if ($request->hasFile('images')) {
            $slider = $this->sliderRepository->saveFiles($slider->id, $request);
        }

        return redirect(locale_route('slider.show', $slider->id))->with('success', 'Slider created.');
    }

    /**
     * Display the specified resource.
     *
     * @param string $locale
     * @param int $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(string $locale, int $id)
    {
        $slider = $this->sliderRepository->findOrFail($id);

        return view('admin.pages.slider.show', [
            'slider' => $slider,
            'languages' => $this->activeLanguages()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $locale
     * @param int $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(string $locale, int $id)
    {
        $slider = $this->sliderRepository->findOrfail($id);
        $type = "homepage";
        $url = locale_route('slider.update', $id, false);

        $method = 'PUT';
        return view('admin.pages.slider.form', [
            'slider' => $slider,
            "type" => $type,
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
     * @param \App\Http\Requests\Admin\SliderRequest $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(string $locale, int $id, SliderRequest $request)
    {
        $data = [
            'url' => $request['url'],
            "type" => $request["type"],
            'status' => (bool)$request['status'],
            'description' => $request['description'],
            'title' => $request['title'],
            'languages' => $this->activeLanguages(),
        ];

        $slider = $this->sliderRepository->update($id, $data);

        // Update Files
        $this->sliderRepository->saveFiles($id, $request);

        return redirect(locale_route('slider.show', $slider->id))->with('success', 'Slider updated.');
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
        if (!$this->sliderRepository->delete($id)) {
            return redirect(locale_route('slider.show', $id))->with('danger', 'Slider not deleted.');
        }
        return redirect(locale_route('slider.index'))->with('success', 'Slider Deleted.');
    }
}

<?php

namespace App\Repositories\Eloquent;

use App\Http\Requests\Admin\CompanyRequest;
use App\Models\Company;
use App\Models\File;
use App\Repositories\CompanyRepositoryInterface;
use App\Repositories\Eloquent\Base\BaseRepository;

use Illuminate\Support\Facades\DB;


class CompanyRepository extends BaseRepository implements CompanyRepositoryInterface
{

//    use ScopeFilter;

    public function __construct(Company $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes = []) :Company
    {
        try {
            DB::connection()->beginTransaction();

            $data = [
                'status' => $attributes['status'],
                'company_link' => $attributes['company_link']
            ];
            $this->model = parent::create($data);

            $companyLanguages = [];

            foreach ($attributes['languages'] as $language) {
                $companyLanguages [] = [
                    'language_id' => $language['id'],
                    'description' => $attributes['description'][$language['id']],
                    'content_title' => $attributes['content_title'][$language['id']],
                    'content_sub_title_1' => $attributes['content_sub_title_1'][$language['id']],
                    'content_sub_title_2' => $attributes['content_sub_title_2'][$language['id']],
                    'content_sub_title_3' => $attributes['content_sub_title_3'][$language['id']],
                    'content_description' => $attributes['content_description'][$language['id']],
                    'content_description_2' => $attributes['content_description_2'][$language['id']],
                    'content_description_3' => $attributes['content_description_3'][$language['id']],

                ];
            }

            $this->model->languages()->createMany($companyLanguages);

            DB::connection()->commit();

            return $this->model;
        } catch (\PDOException $e) {
            DB::connection()->rollBack();
        }
    }

    public function update(int $id, array $data = []): Company
    {
        try {
            DB::connection()->beginTransaction();

            $attributes = [
                'status' => $data['status'],
                'company_link' => $data['company_link']

            ];

            $this->model = parent::update($id, $attributes);
            foreach ($data['languages'] as $language) {
                if (null !== $this->model->language($language['id'])) {
                    $this->model->language($language['id'])->update([
                        'description' => $data['description'][$language['id']],
                        'content_title' => $data['content_title'][$language['id']],
                        'content_sub_title_1' => $data['content_sub_title_1'][$language['id']],
                        'content_sub_title_2' => $data['content_sub_title_2'][$language['id']],
                        'content_sub_title_3' => $data['content_sub_title_3'][$language['id']],
                        'content_description' => $data['content_description'][$language['id']],
                        'content_description_2' => $data['content_description_2'][$language['id']],
                        'content_description_3' => $data['content_description_3'][$language['id']],
                    ]);
                }else{
                    $this->model->languages()->create([
                        'language_id' => $language['id'],
                        'description' => $data['description'][$language['id']],
                        'content_title' => $data['content_title'][$language['id']],
                        'content_sub_title_1' => $data['content_sub_title_1'][$language['id']],
                        'content_sub_title_2' => $data['content_sub_title_2'][$language['id']],
                        'content_sub_title_3' => $data['content_sub_title_3'][$language['id']],
                        'content_description' => $data['content_description'][$language['id']],
                        'content_description_2' => $data['content_description_2'][$language['id']],
                        'content_description_3' => $data['content_description_3'][$language['id']],
                    ]);
                }
            }

            DB::connection()->commit();

            return $this->model;
        } catch (\PDOException $e) {
            DB::connection()->rollBack();
        }
    }

    public function saveFile(int $id, CompanyRequest $request): Company
    {

        $this->model = $this->findOrFail($id);

        // Delete old files if exist
        if (count($this->model->files)) {
            foreach ($this->model->files as $file) {
                if (!$request->old_images) {
                    $file->delete();
                    continue;
                }
                if (!in_array((string)$file->id, $request->old_images, true)) {
                    $file->delete();
                }
            }
        }

        $oldMain = json_decode($request->old_main_image);
        if (!$oldMain && $this->model->mainFile) {
            $this->model->mainFile->delete();
        }


        if ($request->hasFile('main-image')) {
            // Get Name Of model

            $image = $request->file('main-image');
            $imagename = date('Ymhs') . str_replace(' ', '', $image->getClientOriginalName());
            $destination = base_path() . '/storage/app/public/' . 'Company' . '/' . $this->model->id;
            $image->move($destination, $imagename);
            $this->model->files()->create([
                'title' => $imagename,
                'path' => 'storage/' . 'Company' . '/' . $this->model->id,
                'format' => $image->getClientOriginalExtension(),
                'type' => File::FILE_MAIN
            ]);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $file) {
                $imagename = date('Ymhs') . str_replace(' ', '', $file->getClientOriginalName());
                $destination = base_path() . '/storage/app/public/' . 'Company' . '/' . $this->model->id;
                $request->file('images')[$key]->move($destination, $imagename);
                $this->model->files()->create([
                    'title' => $imagename,
                    'path' => 'storage/' . 'Company' . '/' . $this->model->id,
                    'format' => $file->getClientOriginalExtension(),
                    'type' => File::FILE_DEFAULT
                ]);
            }
        }


        return $this->model;
    }


}

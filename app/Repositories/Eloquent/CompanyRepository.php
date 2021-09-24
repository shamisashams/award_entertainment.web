<?php

namespace App\Repositories\Eloquent;

use App\Models\Company;
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
                    ]);
                }else{
                    $this->model->languages()->create([
                        'language_id' => $language['id'],
                        'description' => $data['description'][$language['id']],
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

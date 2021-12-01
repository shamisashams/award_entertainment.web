<?php

namespace App\Repositories\Eloquent;

use App\Models\CompanyDocument;
use App\Models\Document;

use App\Repositories\DocumentRepositoryInerface;
use App\Repositories\DocumentRepositoryInterface;
use App\Repositories\Eloquent\Base\BaseRepository;

use Illuminate\Support\Facades\DB;


class DocumentRepository extends BaseRepository implements DocumentRepositoryInterface
{

//    use ScopeFilter;

    public function __construct(Document $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes = []): Document
    {
        try {
            DB::connection()->beginTransaction();

            $data = [
                'status' => $attributes['status'],
//                'link' => $attributes['link']
            ];
            $this->model = parent::create($data);

            $blogLanguages = [];

            foreach ($attributes['languages'] as $language) {
                $blogLanguages [] = [
                    'language_id' => $language['id'],
                    'title' => $attributes['title'][$language['id']],
                ];
            }
            if ($attributes["companies"]) {

                foreach ($attributes['companies'] as $company) {
                    $arr = array(
                        'document_id' => $this->model->id,
                        'company_id' => $company,
                    );
                    CompanyDocument::create($arr);
                }
            }
//            dd($companies);
//            dd($blogLanguages);
            $this->model->languages()->createMany($blogLanguages);
//            $this->model->company()->createMany($companies);
//            CompanyDocument::insert($companies);

            DB::connection()->commit();

            return $this->model;
        } catch (\Exception $e) {
            dd($e);
            DB::connection()->rollBack();
        }
    }

    public function update(int $id, array $data = []): Document
    {
        try {
            DB::connection()->beginTransaction();

            $attributes = [
                'status' => $data['status'],
//                'link' => $data['link']


            ];

            $this->model = parent::update($id, $attributes);
            foreach ($data['languages'] as $language) {
                if (null !== $this->model->language($language['id'])) {
                    $this->model->language($language['id'])->update([
                        'title' => $data['title'][$language['id']],
                    ]);
                } else {
                    $this->model->languages()->create([
                        'language_id' => $language['id'],
                        'title' => $data['title'][$language['id']],
                    ]);
                }
            }
            if ($data["companies"]) {
                $oldCompanies = array_column($this->model->companies()->get()->toArray(), "company_id");
                foreach ($data["companies"] as $company) {
                    if (($key = array_search($company, $oldCompanies)) !== false) {
                        unset($oldCompanies[$key]);
                    }


                    if (!$this->model->companyCheck($company)) {
                        $this->model->companies()->create([
                            "company_id" => $company,
                            "document_id" => $this->model->id
                        ]);
                    }
                }
                $this->model->companies()->whereIn("company_id", $oldCompanies)->delete();
            } else {
                $this->model->companies()->delete();
            }

            DB::connection()->commit();

            return $this->model;
        } catch (\PDOException $e) {
            DB::connection()->rollBack();
        }
    }


}

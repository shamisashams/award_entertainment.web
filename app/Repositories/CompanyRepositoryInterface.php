<?php

namespace App\Repositories;

use App\Http\Requests\Admin\CompanyRequest;
use App\Models\Company;

interface CompanyRepositoryInterface
{
    public function update(int $id, array $data = []): Company;

    public function create(array $attributes): Company;
    public function saveFile(int $id, CompanyRequest $request): Company;
}

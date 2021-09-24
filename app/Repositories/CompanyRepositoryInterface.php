<?php

namespace App\Repositories;

use App\Models\Company;

interface CompanyRepositoryInterface
{
    public function update(int $id, array $data = []): Company;

    public function create(array $attributes): Company;
}

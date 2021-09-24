<?php

namespace App\Repositories;

use App\Models\Page;

interface PageRepositoryInterface
{
    public function update(int $id, array $data = []): Page;

    public function create(array $attributes): Page;
}

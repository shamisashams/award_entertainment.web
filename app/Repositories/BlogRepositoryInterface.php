<?php

namespace App\Repositories;

use App\Http\Request\Admin\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;

interface BlogRepositoryInterface
{
    public function update(int $id, array $data = []): Blog;

    public function create(array $attributes): Blog;
}

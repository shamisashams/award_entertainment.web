<?php

namespace App\Repositories;


use App\Http\Requests\Admin\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;

interface BlogRepositoryInterface
{
    public function update(int $id, array $data = []): Blog;

    public function create(array $attributes): Blog;
    public function saveFile(int $id, BlogRequest $request): Blog;

}

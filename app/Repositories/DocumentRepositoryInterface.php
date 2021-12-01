<?php

namespace App\Repositories;

use App\Http\Requests\Admin\BlogRequest;
use App\Models\Blog;
use App\Models\Document;
use Illuminate\Http\Request;

interface DocumentRepositoryInterface
{
    public function update(int $id, array $data ): Document;

    public function create(array $attributes): Document;

}

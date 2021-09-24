<?php

namespace App\Repositories;

//use App\Http\Request\Admin\BlogRequest;
use App\Models\Gallery;
use Illuminate\Http\Request;

interface GalleryRepositoryInterface
{
//    public function update(int $id, array $data = []): Gallery;
//
    public function create(array $attributes): Gallery;
}

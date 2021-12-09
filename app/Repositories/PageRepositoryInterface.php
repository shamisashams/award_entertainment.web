<?php

namespace App\Repositories;

use App\Models\Page;

interface PageRepositoryInterface
{
    /**
     * @param int $id
     * @param array $data
     * @return Page
     */
    public function update(int $id, array $data = []): Page;

    /**
     * @param array $attributes
     * @return Page
     */
    public function create(array $attributes): Page;

    /**
     * @return Page
     */
    public function getFirstTworecordsId();
}

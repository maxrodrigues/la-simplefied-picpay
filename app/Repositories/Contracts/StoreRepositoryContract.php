<?php

namespace App\Repositories\Contracts;

use App\Models\Store;

interface StoreRepositoryContract
{
    public function create(array $payload): Store;
}

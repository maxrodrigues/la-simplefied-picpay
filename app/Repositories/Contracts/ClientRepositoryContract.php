<?php

namespace App\Repositories\Contracts;

use App\Models\Client;

interface ClientRepositoryContract
{
    public function create(array $payload): Client;
}

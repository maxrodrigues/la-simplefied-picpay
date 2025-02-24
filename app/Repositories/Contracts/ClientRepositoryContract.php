<?php

namespace App\Repositories\Contracts;

use App\Models\Client;
use App\Repositories\BaseRepository;

interface ClientRepositoryContract
{
    public function create(array $payload): Client;
}

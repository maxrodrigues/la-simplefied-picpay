<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryContract;
use Illuminate\Support\Facades\Hash;

class ClientRepository extends BaseRepository implements ClientRepositoryContract
{
    public function __construct(private readonly Client $model)
    {
        //
    }

    public function create(array $payload): Client
    {
        $client = $this->model->create([
            'name'     => $payload['name'],
            'document' => $payload['document'],
        ]);

        $client->user()->create([
            'name'     => $payload['name'],
            'email'    => $payload['email'],
            'password' => Hash::make($payload['password']),
        ]);

        return $client;
    }
}

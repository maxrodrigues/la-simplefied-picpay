<?php

namespace App\Repositories;

use App\Models\Store;
use App\Repositories\Contracts\StoreRepositoryContract;
use Dotenv\Repository\RepositoryInterface;
use Illuminate\Support\Facades\Hash;

class StoreRepository extends BaseRepository implements StoreRepositoryContract
{
    public function __construct(private readonly Store $model)
    {
        //
    }

    public function create(array $payload): Store
    {
        $store = $this->model->create([
            'name' => $payload['name'],
            'address' => $payload['address'],
            'phone' => $payload['phone'],
            'document' => $payload['document'],
        ]);

        $store->user()->create([
            'name' => $payload['name'],
            'email' => $payload['email'],
            'password' => Hash::make($payload['password']),
        ]);

        return $store;
    }

}

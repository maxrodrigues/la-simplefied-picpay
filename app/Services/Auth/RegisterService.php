<?php

namespace App\Services\Auth;

use App\Models\Client;
use App\Repositories\ClientRepository;
use App\Repositories\Contracts\ClientRepositoryContract;
use App\Repositories\Contracts\StoreRepositoryContract;
use App\Services\Auth\Contracts\RegisterContract;

class RegisterService implements RegisterContract
{
    public function __construct(
        private readonly ClientRepositoryContract $clientRepository,
        private readonly StoreRepositoryContract $storeRepository,
    )
    {
    }

    public function register(array $payload)
    {
        return match ($payload['type']) {
            'client' => $this->createNewClient($payload),
            'store' => $this->createNewStore($payload),
        };
    }

    public function createNewClient(array $payload): bool
    {
        if ($this->clientRepository->create($payload)) {
            return true;
        }

        return false;
    }

    public function createNewStore(array $payload): bool
    {
        if ($this->storeRepository->create($payload)) {
            return true;
        }

        return false;
    }
}

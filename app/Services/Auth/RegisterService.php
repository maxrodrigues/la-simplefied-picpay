<?php

namespace App\Services\Auth;

use App\Repositories\Contracts\ClientRepositoryContract;
use App\Repositories\Contracts\StoreRepositoryContract;
use App\Services\Auth\Contracts\RegisterContract;
use App\Services\Contracts\ClientServiceContract;
use App\Services\Contracts\StoreServiceContract;
use Exception;

class RegisterService implements RegisterContract
{
    public function __construct(
        private readonly ClientRepositoryContract $clientRepository,
        private readonly StoreRepositoryContract $storeRepository,
        private readonly StoreServiceContract $storeService,
        private readonly ClientServiceContract $clientService,
    ) {}

    public function register(array $payload): bool
    {
        return match ($payload['type']) {
            'client' => $this->createNewClient($payload),
            'store' => $this->createNewStore($payload),
        };
    }

    public function createNewClient(array $payload): bool
    {
        $isDocumentExists = $this->clientService->isDocumentExists($payload['document']);
        if ($isDocumentExists) {
            throw new Exception('Already exists user with this CPF');
        }

        $this->clientRepository->create($payload);

        return false;
    }

    public function createNewStore(array $payload): bool
    {
        $isDocumentExists = $this->storeService->isDocumentExists($payload['document']);

        if ($isDocumentExists) {
            throw new Exception('Already exists user with this CNPJ');
        }

        $this->storeRepository->create($payload);

        return true;
    }
}

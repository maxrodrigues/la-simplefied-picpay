<?php

namespace App\Services;

use App\Repositories\Contracts\StoreRepositoryContract;
use App\Services\Contracts\StoreServiceContract;

class StoreService implements StoreServiceContract
{
    public function __construct(private readonly StoreRepositoryContract $storeRepository) {}

    public function isDocumentExists(string $document): bool
    {
        if (! $this->storeRepository->getDocument($document)) {
            return false;
        }

        return true;
    }
}

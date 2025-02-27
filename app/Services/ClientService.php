<?php

namespace App\Services;

use App\Repositories\Contracts\ClientRepositoryContract;
use App\Services\Contracts\ClientServiceContract;

class ClientService implements ClientServiceContract
{
    public function __construct(private readonly ClientRepositoryContract $clientRepository) {}

    public function isDocumentExists(string $document): bool
    {
        if (! $this->clientRepository->getDocument($document)) {
            return false;
        }

        return true;
    }
}

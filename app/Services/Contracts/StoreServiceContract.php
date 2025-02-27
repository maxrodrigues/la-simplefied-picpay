<?php

namespace App\Services\Contracts;

interface StoreServiceContract
{
    public function isDocumentExists(string $document): bool;
}

<?php

namespace App\Services\Contracts;

interface ClientServiceContract
{
    public function isDocumentExists(string $document): bool;
}

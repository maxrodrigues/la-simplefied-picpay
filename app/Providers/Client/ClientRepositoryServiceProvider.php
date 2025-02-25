<?php

namespace App\Providers\Client;

use App\Repositories\ClientRepository;
use App\Repositories\Contracts\ClientRepositoryContract;
use Illuminate\Support\ServiceProvider;

class ClientRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ClientRepositoryContract::class, ClientRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

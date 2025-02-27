<?php

namespace App\Providers\Client;

use App\Services\ClientService;
use App\Services\Contracts\ClientServiceContract;
use Illuminate\Support\ServiceProvider;

class ClientServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ClientServiceContract::class, ClientService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

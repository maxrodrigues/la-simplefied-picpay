<?php

namespace App\Providers\Store;

use App\Services\Contracts\StoreServiceContract;
use App\Services\StoreService;
use Illuminate\Support\ServiceProvider;

class StoreServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(StoreServiceContract::class, StoreService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

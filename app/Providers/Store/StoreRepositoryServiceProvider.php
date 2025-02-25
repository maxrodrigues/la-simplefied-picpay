<?php

namespace App\Providers\Store;

use App\Repositories\Contracts\StoreRepositoryContract;
use App\Repositories\StoreRepository;
use Illuminate\Support\ServiceProvider;

class StoreRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(StoreRepositoryContract::class, StoreRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

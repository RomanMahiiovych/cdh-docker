<?php

namespace App\Providers;

use App\Services\External\AdminkoAPI\AdminkoApiClient;
use App\Services\External\APICompaniesInterface;
use Illuminate\Support\ServiceProvider;

class CompaniesServiceProvider extends ServiceProvider
{
    public array $bindings = [
        APICompaniesInterface::class => AdminkoApiClient::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->singleton(AdminkoApiClient::class,
            fn () => new AdminkoApiClient(
                config('services.adminko.x_client_header'),
                config('services.adminko.uri')
            ));
    }
}

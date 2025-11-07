<?php

namespace App\Providers;

use App\Models\Application\AppModule;
use Illuminate\Support\ServiceProvider;
use App\Models\Application\AppModuleRoute;
use App\Services\Application\Settings\EditAppModuleService;
use App\Services\Application\Settings\EditAppModuleRouteService;

class ApplicationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        app()->bind(EditAppModuleService::class, function () {
            return new EditAppModuleService(new AppModule());
        });

        app()->bind(EditAppModuleRouteService::class, function () {
            return new EditAppModuleRouteService(new AppModuleRoute());
        });

        $this->app->bind(AppModuleRoute::class, function () {
            return new AppModuleRoute;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

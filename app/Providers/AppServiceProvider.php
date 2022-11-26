<?php

namespace App\Providers;

use App\Contracts\Interfaces\IAuthService;
use App\Contracts\Interfaces\IBaseApiResponseService;
use App\Services\Api\Auth\ApiAuthService as AuthApiAuthService;
use App\Services\Api\Standartisation\JsonApiResponceService;
use App\Services\Auth\ApiAuthService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IBaseApiResponseService::class, function ($app) {
            return new JsonApiResponceService();
        });
        $this->app->singleton(IAuthService::class, function ($app) {
            return new AuthApiAuthService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

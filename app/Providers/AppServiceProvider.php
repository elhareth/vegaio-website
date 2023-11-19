<?php

namespace App\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('service:site.options', function (Application $app) {
            return new \App\Services\SiteOptions;
        });

        $this->app->singleton('service:repo.categories', function (Application $app) {
            return new \App\Services\CategoriesRepository;
        });

        $this->app->singleton('service:repo.services', function (Application $app) {
            return new \App\Services\ServicesRepository;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

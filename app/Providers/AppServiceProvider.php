<?php

namespace App\Providers;

use App\Class\Ejabberd\EjabberdClient;
use App\Class\Ejabberd\EjabberdConfig;
use App\Models\Domain;
use App\Observers\DomainObserver;
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
        $this->app->bind('EjabberdConfig', function ($app){
            return new EjabberdConfig;
        });
        $this->app->bind('EjabberdClient', function ($app){
            return new EjabberdClient;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Domain::observe(DomainObserver::class);
    }
}

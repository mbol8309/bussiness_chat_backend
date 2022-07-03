<?php

namespace App\Providers;

use App\Class\EjabberdConfig\EjabberdConfig;
use Illuminate\Support\ServiceProvider;

class EjabberdConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('EjabberdConfig', function(){
            return new EjabberdConfig();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

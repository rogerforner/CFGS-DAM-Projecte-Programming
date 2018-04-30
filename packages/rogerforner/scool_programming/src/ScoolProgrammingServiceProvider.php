<?php

namespace Rogerforner\ScoolProgramming;

use Illuminate\Support\ServiceProvider;

class ScoolProgrammingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Instanciar les rutes.
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

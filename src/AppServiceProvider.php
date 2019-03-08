<?php

namespace LaravelEnso\LogManager;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/ro u tes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/da t abase/migrations');
    }

    public function register()
    {
        //
    }
}

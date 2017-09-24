<?php

namespace LaravelEnso\LogManager;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class LogsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register()
    {
        //
    }
}

<?php

namespace LaravelEnso\LogManager;

use Illuminate\Support\ServiceProvider;

class LogManagerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishesAll();
        $this->loadDependencies();
    }

    private function publishesAll()
    {
        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/laravel-enso/logmanager'),
        ], 'logmanager-views');
    }

    public function loadDependencies()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'laravel-enso/logmanager');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register()
    {
        //
    }
}

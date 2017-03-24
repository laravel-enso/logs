<?php

namespace LaravelEnso\LogManager;

use Illuminate\Support\ServiceProvider;

class LogManagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishesAll();
        $this->loadDependencies();
    }

    private function publishesAll()
    {
        $this->publishes([
            __DIR__.'/config/logmanager.php' => config_path('logmanager.php'),
        ], 'logmanager-config');

        $this->publishes([
            __DIR__.'/database/migrations' => database_path('migrations'),
        ], 'logmanager-migration');

        $this->publishes([
            __DIR__.'/app/notifications' => app_path('notifications/vendor/laravel-enso'),
        ], 'logmanager-notification');

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

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

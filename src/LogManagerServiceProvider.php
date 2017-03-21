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
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'logmanager');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../config/logmanager.php' => config_path('logmanager.php'),
        ], 'logmanager-config');

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'logmanager-migration');

        $this->publishes([
            __DIR__.'/notifications' => app_path('notifications/vendor/laravel-enso'),
        ], 'logmanager-notification');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-enso/logmanager'),
        ], 'logmanager-views');
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

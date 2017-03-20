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
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/../resources/views/system/logManager', 'logmanager');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->publishes([
            __DIR__ . '/../config/logmanager.php' => config_path('logmanager.php'),
        ], 'logmanager-config');

        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'logmanager-migration');

        $this->publishes([
            __DIR__ . '/notifications' => app_path('notifications'),
        ], 'logmanager-notification');

        $this->publishes([
            __DIR__ . '/../resources' => base_path('resources'),
        ], 'logmanager-resources');
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

<?php

Route::middleware(['web', 'auth', 'core'])
    ->namespace('LaravelEnso\Logs\app\Http\Controllers')
    ->prefix('api/system/logs')
    ->as('system.logs.')
    ->group(function () {
        require 'app/logs.php';
    });

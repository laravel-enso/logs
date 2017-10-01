<?php

Route::middleware(['auth:api', 'api', 'core'])
    ->prefix('api')
    ->namespace('LaravelEnso\LogManager\app\Http\Controllers')
    ->prefix('system')->as('system.')
    ->group(function () {
        Route::get('logs/download/{log}', 'LogController@download')
            ->name('logs.download');

        Route::resource('logs', 'LogController', ['only' => ['show', 'index', 'destroy']]);
    });

<?php

Route::middleware(['web', 'auth', 'core'])
    ->prefix('api/system')->as('system.')
    ->namespace('LaravelEnso\LogManager\app\Http\Controllers')
    ->group(function () {
        Route::get('logs/download/{log}', 'LogController@download')
            ->name('logs.download');

        Route::resource('logs', 'LogController', ['only' => ['show', 'index', 'destroy']]);
    });

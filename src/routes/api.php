<?php

Route::middleware(['web', 'auth', 'core'])
    ->namespace('LaravelEnso\Logs\app\Http\Controllers')
    ->prefix('api/system/logs')
    ->as('system.logs.')
    ->group(function () {
        Route::get('', 'Index')->name('index');
        Route::delete('{log}', 'Destroy')->name('destroy');
        Route::delete('{log}', 'Destroy')->name('destroy');
        Route::get('{log}/download', 'Download')->name('download');
        Route::get('{log}', 'Show')->name('show');
    });

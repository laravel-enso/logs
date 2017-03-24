<?php

Route::group(['namespace' => 'LaravelEnso\LogManager\App\Http\Controllers', 'middleware' => ['web', 'auth', 'core']], function () {
    Route::group(['prefix' => 'system/logs', 'as' => 'system.logs.'], function () {
        Route::get('', 'LogManagerController@index')->name('index');
        Route::get('{log}', 'LogManagerController@show')->name('show');
        Route::get('download/{log}', 'LogManagerController@download')->name('download');
        Route::delete('{log}', 'LogManagerController@destroy')->name('destroy');
    });
});

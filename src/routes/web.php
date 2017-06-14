<?php

Route::group([
	'namespace' => 'LaravelEnso\LogManager\app\Http\Controllers',
	'middleware' => ['web', 'auth', 'core']
], function () {
    Route::group(['prefix' => 'system/logs', 'as' => 'system.logs.'], function () {
        Route::get('', 'LogController@index')->name('index');
        Route::get('{log}', 'LogController@show')->name('show');
        Route::get('download/{log}', 'LogController@download')->name('download');
        Route::delete('{log}', 'LogController@destroy')->name('destroy');
    });
});

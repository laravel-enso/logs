<?php

Route::get('', 'Index')->name('index');
Route::delete('{log}', 'Destroy')->name('destroy');
Route::delete('{log}', 'Destroy')->name('destroy');
Route::get('{log}/download', 'Download')->name('download');
Route::get('{log}', 'Show')->name('show');

<?php

use Illuminate\Support\Facades\Route;
//supervisord
Route::get('/', 'SupervisordController@index')->name('lsc_index');
Route::get('/shutdown', 'SupervisordController@shutdown')->name('lsc_shutdown');
Route::get('/restart', 'SupervisordController@restart')->name('lsc_restart');
//process
Route::group(['prefix' => 'process'], function () {
    Route::get('stop/{id}', 'SupervisordProcessController@stop')->name("lsc_proc_stop");
    Route::get('start/{id}', 'SupervisordProcessController@start')->name("lsc_proc_start");
});

//groups
Route::group(['prefix' => 'group'], function () {
    Route::get('stop/{id}', 'SupervisordGroupController@stop')->name("lsc_group_stop");
    Route::get('start/{id}', 'SupervisordGroupController@start')->name("lsc_group_start");
});

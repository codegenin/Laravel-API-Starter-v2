<?php

Route::group(['prefix' => 'users'], function () {
    
    ############## Default Routes ########################
    Route::get('/', 'App\ACME\Admin\User\Controllers\IndexUserController@run')
         ->name('admin.user.index');
    
    ############## CRUD Routes ###########################
    Route::post('new', 'App\ACME\Admin\User\Controllers\StoreUserController@run')
         ->name('admin.user.store');
    Route::post('delete', 'App\ACME\Admin\User\Controllers\DestroyUserController@run')
         ->name('admin.user.destroy');
    Route::get('{id}/get', 'App\ACME\Admin\User\Controllers\AjaxGetUserController@run')
         ->name('admin.user.get');
    Route::post('update', 'App\ACME\Admin\User\Controllers\UpdateUserController@run')
         ->name('admin.user.update');
    
});
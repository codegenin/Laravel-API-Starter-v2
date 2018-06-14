<?php

Route::group(['prefix' => 'collections'], function () {
    
    ############## Admin Routes ###########################
    Route::get('/', 'App\ACME\Admin\Collection\Controllers\IndexController@run')
         ->name('admin.collection.index');
    Route::get('{id}/get', 'App\ACME\Admin\Collection\Controllers\AjaxGetCollectionController@run')
         ->name('admin.collection.ajax.get');
    Route::post('update', 'App\ACME\Admin\Collection\Controllers\UpdateController@run')
         ->name('admin.collection.update');
    
    Route::post('/store', 'App\ACME\Admin\Collection\Controllers\StoreController@run')
         ->name('admin.collection.store');
    
});
<?php

Route::group(['prefix' => 'collections'], function () {
    
    ############## Admin Routes ###########################
    Route::get('/', 'App\ACME\Admin\Collection\Controllers\IndexController@run')
         ->name('admin.collection.index');
    Route::get('{id}/get', 'App\ACME\Admin\Collection\Controllers\AjaxGetCollectionController@run')
         ->name('admin.collection.ajax.get');
    Route::get('{id}/images', 'App\ACME\Admin\Collection\Controllers\ImagesCollectionController@run')
         ->name('admin.collection.images');
    Route::post('update', 'App\ACME\Admin\Collection\Controllers\UpdateCollectionController@run')
         ->name('admin.collection.update');
    Route::post('/upload', 'App\ACME\Admin\Collection\Controllers\UploadImageController@run')
         ->name('admin.collection.upload');
    Route::post('/store', 'App\ACME\Admin\Collection\Controllers\StoreCollectionController@run')
         ->name('admin.collection.store');
    
});
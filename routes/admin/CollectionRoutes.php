<?php

Route::group(['prefix' => 'collections'], function () {
    
    ############## Admin Routes ###########################
    Route::get('/', 'App\ACME\Admin\Collection\Controllers\IndexController@run')
         ->name('admin.collection.index');
    Route::get('{id}/images', 'App\ACME\Admin\Collection\Controllers\ImagesCollectionController@run')
         ->name('admin.collection.images');
    Route::get('{id}/image-for-table', 'App\ACME\Admin\Collection\Controllers\ImagesTableCollectionController@run')
        ->name('admin.collection.images.get');
    Route::post('/upload', 'App\ACME\Admin\Collection\Controllers\UploadImageController@run')
         ->name('admin.collection.upload');
    
    
    ################## CRUD Operations ##################################
    Route::post('/store', 'App\ACME\Admin\Collection\Controllers\StoreCollectionController@run')
         ->name('admin.collection.store');
    Route::get('{id}/get', 'App\ACME\Admin\Collection\Controllers\AjaxGetCollectionController@run')
         ->name('admin.collection.ajax.get');
    Route::post('update', 'App\ACME\Admin\Collection\Controllers\UpdateCollectionController@run')
         ->name('admin.collection.update');
    Route::post('delete', 'App\ACME\Admin\Collection\Controllers\DestroyCollectionController@run')
         ->name('admin.collection.destroy');
    
});
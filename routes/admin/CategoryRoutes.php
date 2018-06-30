<?php

Route::group(['prefix' => 'categories'], function () {
    
    ############## Default Routes ########################
    Route::get('/', 'App\ACME\Admin\Category\Controllers\IndexCategoryController@run')
         ->name('admin.category.index');
    Route::get('{id}/collections', 'App\ACME\Admin\Category\Controllers\ListCollectionsController@run')
         ->name('admin.category.collections');
    
    ############## CRUD Routes ###########################
    Route::post('new', 'App\ACME\Admin\Category\Controllers\StoreCategoryController@run')
         ->name('admin.category.store');
    Route::post('delete', 'App\ACME\Admin\Category\Controllers\DestroyCategoryController@run')
         ->name('admin.category.destroy');
    Route::get('{id}/get', 'App\ACME\Admin\Category\Controllers\CategoryController@get')
         ->name('admin.category.get');
    Route::post('update', 'App\ACME\Admin\Category\Controllers\UpdateCategoryController@run')
         ->name('admin.category.update');
    
    ############## Moving Sequence ###########################
    Route::get('{id}/move-to-start', 'App\ACME\Admin\Category\Controllers\MoveCategoryController@moveToStart')
         ->name('admin.category.move.to.start');
    Route::get('{id}/move-up', 'App\ACME\Admin\Category\Controllers\MoveCategoryController@up')
         ->name('admin.category.move.up');
    Route::get('{id}/move-down', 'App\ACME\Admin\Category\Controllers\MoveCategoryController@down')
         ->name('admin.category.move.down');
    Route::get('{id}/move-to-end', 'App\ACME\Admin\Category\Controllers\MoveCategoryController@moveToEnd')
         ->name('admin.category.move.to.end');
    
    ############## Images Routes ##############################
    Route::get('{id}/images', 'App\ACME\Admin\Category\Controllers\ListImagesController@run')
         ->name('admin.category.images');
    Route::post('upload', 'App\ACME\Admin\Category\Controllers\UploadImageController@run')
         ->name('admin.category.upload');
});
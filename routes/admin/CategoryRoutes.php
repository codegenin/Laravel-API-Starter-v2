<?php

Route::group(['prefix' => 'categories'], function () {
    
    ############## Admin Routes ###########################
    Route::get('/', 'App\ACME\Admin\Category\Controllers\CategoryController@index')
         ->name('admin.category.index');
    Route::post('new', 'App\ACME\Admin\Category\Controllers\CategoryController@store')
         ->name('admin.category.store');
    Route::post('delete', 'App\ACME\Admin\Category\Controllers\CategoryController@destroy')
         ->name('admin.category.destroy');
    Route::get('{id}/get', 'App\ACME\Admin\Category\Controllers\CategoryController@get')
         ->name('admin.category.get');
    Route::post('update', 'App\ACME\Admin\Category\Controllers\CategoryController@update')
         ->name('admin.category.update');
    
    ############## Moving Sequence ###########################
    Route::get('{id}/move-up', 'App\ACME\Admin\Category\Controllers\MoveCategoryController@up')
         ->name('admin.category.move.up');
    Route::get('{id}/move-down', 'App\ACME\Admin\Category\Controllers\MoveCategoryController@down')
         ->name('admin.category.move.down');
    
});
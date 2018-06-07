<?php

Route::group(['prefix' => 'categories'], function () {
    
    ############## Admin Routes ###########################
    Route::get('/', 'App\ACME\Admin\Category\Controllers\CategoryController@index')
         ->name('admin.category.index');
    
    ############## Moving Sequence ###########################
    Route::get('{id}/move-up', 'App\ACME\Admin\Category\Controllers\MoveCategoryController@up')
         ->name('admin.category.move.up');
    Route::get('{id}/move-down', 'App\ACME\Admin\Category\Controllers\MoveCategoryController@down')
         ->name('admin.category.move.down');
    
});
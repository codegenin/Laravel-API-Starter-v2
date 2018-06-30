<?php

Route::group(['prefix' => 'tags'], function () {
    
    ############## Default Routes ########################
    Route::get('/', 'App\ACME\Admin\Tag\Controllers\IndexTagController@run')
         ->name('admin.tag.index');
    
    ############## CRUD Routes ###########################
    Route::post('new', 'App\ACME\Admin\Tag\Controllers\StoreTagController@run')
         ->name('admin.tag.store');
    Route::post('delete', 'App\ACME\Admin\Tag\Controllers\DestroyTagController@run')
         ->name('admin.tag.destroy');
    Route::get('{id}/get', 'App\ACME\Admin\Tag\Controllers\AjaxGetTagController@run')
         ->name('admin.tag.get');
    Route::post('update', 'App\ACME\Admin\Tag\Controllers\UpdateTagController@run')
         ->name('admin.tag.update');
    
});
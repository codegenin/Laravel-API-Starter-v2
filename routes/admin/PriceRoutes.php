<?php

Route::group(['prefix' => 'prices'], function () {
    
    ############## Default Routes ########################
    Route::get('/', 'App\ACME\Admin\Price\Controllers\IndexPriceController@run')
         ->name('admin.price.index');
    
    ############## CRUD Routes ###########################
    Route::post('new', 'App\ACME\Admin\Price\Controllers\StorePriceController@run')
         ->name('admin.price.store');
    Route::post('delete', 'App\ACME\Admin\Price\Controllers\DestroyPriceController@run')
         ->name('admin.price.destroy');
    Route::get('{id}/get', 'App\ACME\Admin\Price\Controllers\AjaxGetPriceController@run')
         ->name('admin.price.get');
    Route::post('update', 'App\ACME\Admin\Price\Controllers\UpdatePriceController@run')
         ->name('admin.price.update');
    
});
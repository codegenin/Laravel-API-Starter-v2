<?php

Route::group(['prefix' => 'settings'], function () {
    
    ############## Default Routes ########################
    Route::get('/', 'App\ACME\Admin\Setting\Controllers\IndexSettingController@run')
         ->name('admin.setting.index');
    
    ############## CRUD Routes ###########################
    Route::post('new', 'App\ACME\Admin\Setting\Controllers\StoreSettingController@run')
         ->name('admin.setting.store');
    Route::post('delete', 'App\ACME\Admin\Setting\Controllers\DestroySettingController@run')
         ->name('admin.setting.destroy');
    Route::get('{id}/get', 'App\ACME\Admin\Setting\Controllers\AjaxGetSettingController@run')
         ->name('admin.setting.get');
    Route::post('update', 'App\ACME\Admin\Setting\Controllers\UpdateSettingController@run')
         ->name('admin.setting.update');
});
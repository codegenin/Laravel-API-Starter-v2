<?php

Route::group(['prefix' => 'roles'], function () {
    
    ############## Default Routes ########################
    Route::get('/', 'App\ACME\Admin\Role\Controllers\IndexRoleController')
         ->name('admin.role.index');
    
    ############## CRUD Routes ###########################
    Route::post('new', 'App\ACME\Admin\Report\Controllers\StoreReportController@run')
         ->name('admin.report.store');
    Route::post('delete', 'App\ACME\Admin\Report\Controllers\DestroyReportController@run')
         ->name('admin.report.destroy');
    Route::get('{id}/get', 'App\ACME\Admin\Report\Controllers\AjaxGetReportController@run')
         ->name('admin.report.get');
    Route::post('update', 'App\ACME\Admin\Report\Controllers\UpdateReportController@run')
         ->name('admin.report.update');
    
});
<?php

Route::group(['prefix' => 'imports'], function () {
    
    ############## Default Routes ########################
    Route::get('/', 'App\ACME\Admin\Import\Controllers\IndexImportController@run')
         ->name('admin.import.index');
    Route::post('/', 'App\ACME\Admin\Import\Controllers\ImportFileController@run')
         ->name('admin.import.file');
    
    Route::post('delete', 'App\ACME\Admin\Import\Controllers\DestroyImportController@run')
         ->name('admin.import.destroy');
});
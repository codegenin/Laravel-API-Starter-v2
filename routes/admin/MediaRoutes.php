<?php

Route::group(['prefix' => 'media'], function () {
    
    ############## Admin Routes ###########################
    Route::post('/delete', 'App\ACME\Admin\Media\Controllers\DestroyController@run')
         ->name('admin.media.destroy');
    
});
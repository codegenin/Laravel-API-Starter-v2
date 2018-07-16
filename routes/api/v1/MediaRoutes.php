<?php

Route::group(['prefix' => 'media'], function () {
    
    Route::post('upload-image', 'App\\ACME\\Api\\V1\\Media\\Controllers\\UploadToCategoryController@run')
        ->middleware('role.artist');
    Route::get('user/{id}/images', 'App\\ACME\\Api\\V1\\Media\\Controllers\\ListUserImagesController@run')
        ->middleware('role.artist');
    
    Route::get('{id}/show', 'App\\ACME\\Api\\V1\\Media\\Controllers\\ViewImageController@run');
    
    
    ############# INCREMENT / DECREMENT #######################
    Route::post('increment', 'App\\ACME\\Api\\V1\\Media\\Controllers\\ScoreIncrementController@run');
    Route::post('decrement', 'App\\ACME\\Api\\V1\\Media\\Controllers\\ScoreDecrementController@run');
    
});
<?php

Route::group(['prefix' => 'collection'], function () {
    
    Route::get('{id}/images', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\ListImagesController@run');
    Route::get('{id}/show', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\ViewCollectionController@run');
    Route::get('{id}/is-user-favorite', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\IsUserFavoriteController@run');
    
    ############## DISABLED #############################
    #Route::post('create', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\CreateCollectionController@run');
    #Route::post('upload-image', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\AddMediaToCollectionController@run');
    
});
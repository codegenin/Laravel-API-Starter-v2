<?php

Route::group(['prefix' => 'collection'], function () {
    
    Route::get('{id}/images', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\ListImagesController@run');
    Route::get('{id}/all-images', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\ListAllImagesController@run');
    Route::get('{id}/show', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\ViewCollectionController@run');
    Route::get('{id}/is-user-favorite', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\IsUserFavoriteController@run');
    
    Route::get('all-recent-collections', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\CollectionsRecentController@run');
    Route::get('all-alphabetical-collections', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\CollectionsAlphabeticalController@run');
    
    Route::get('{id}/info/{image}/booked', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\ListImagesAndIsBookedController@run');
    
    ############## DISABLED #############################
    #Route::post('create', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\CreateCollectionController@run');
    #Route::post('upload-image', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\AddMediaToCollectionController@run');
    
});
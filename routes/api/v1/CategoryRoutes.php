<?php

Route::group(['prefix' => 'category'], function () {
    
    Route::get('list-all', 'App\\ACME\\Api\\V1\\Category\\Controllers\\ListCategoryController@run');
    Route::get('{id}/show', 'App\\ACME\\Api\\V1\\Category\\Controllers\\ViewCategoryController@run');
    Route::get('{id}/collections', 'App\\ACME\\Api\\V1\\Category\\Controllers\\ListCollectionsController@run');
    Route::get('{id}/images', 'App\\ACME\\Api\\V1\\Category\\Controllers\\ListImagesController@run');
    Route::get('{id}/is-user-favorite', 'App\\ACME\\Api\\V1\\Category\\Controllers\\IsUserFavoriteController@run');
    
    ################ FILTERED BY DATE ####################################
    Route::get('{id}/images/day',
        'App\\ACME\\Api\\V1\\Category\\Controllers\\FilterImagesByDayController@run');
    Route::get('{id}/images/week',
        'App\\ACME\\Api\\V1\\Category\\Controllers\\FilterImagesByWeekController@run');
    Route::get('{id}/images/month',
        'App\\ACME\\Api\\V1\\Category\\Controllers\\FilteImagesByMonthController@run');
    
    ################ COLLECTION RANDOM OR RECENT ############################
    Route::get('{id}/recent-collections',
        'App\\ACME\\Api\\V1\\Category\\Controllers\\CollectionsRecentController@run');
    Route::get('{id}/alphabetical-collections',
        'App\\ACME\\Api\\V1\\Category\\Controllers\\CollectionsAlphabeticalController@run');
    
    ################ ARCHIVE OR RECENT ############################
    Route::get('{id}/archive-images',
        'App\\ACME\\Api\\V1\\Category\\Controllers\\ImagesArchiveController@run');
    Route::get('{id}/recent-images',
        'App\\ACME\\Api\\V1\\Category\\Controllers\\ImagesRecentController@run');
    Route::get('{id}/random-images',
        'App\\ACME\\Api\\V1\\Category\\Controllers\\ImagesRandomController@run');
});
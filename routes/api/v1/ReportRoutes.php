<?php
Route::group(['prefix' => 'report'], function () {
    
    Route::get('{id}/image', 'App\\ACME\\Api\\V1\\Report\\Controllers\\ReportMediaController@run');
    Route::get('{id}/collection', 'App\\ACME\\Api\\V1\\Report\\Controllers\\ReportCollectionController@run');
    
    Route::get('user-reports', 'App\\ACME\\Api\\V1\\Report\\Controllers\\ListUserReportsController@run');
    
});
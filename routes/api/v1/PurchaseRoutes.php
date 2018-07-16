<?php

Route::group(['prefix' => 'purchase'], function () {
    
    Route::get('{id}/collection', 'App\\ACME\\Api\\V1\\Purchase\\Controllers\\PurchaseCollectionController@run');
    
    Route::get('user-purchases', 'App\\ACME\\Api\\V1\\Purchase\\Controllers\\ListUserPurchasesController@run');
    Route::post('user-points', 'App\\ACME\\Api\\V1\\Purchase\\Controllers\\PurchasePointsController@run');
    
});
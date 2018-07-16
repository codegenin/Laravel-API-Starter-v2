<?php

Route::group(['prefix' => 'search'], function () {
    
    Route::get('{term}/all', 'App\\ACME\\Api\\V1\\Search\\Controllers\\SearchAllController@run');
    
});
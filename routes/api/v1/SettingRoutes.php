<?php

Route::group(['prefix' => 'setting'], function () {
    
    Route::get('price-list', 'App\\ACME\\Api\\V1\\Setting\\Controllers\\PriceListController@run');
    
});
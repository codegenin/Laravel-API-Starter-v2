<?php

use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version('v1', function (Router $api) {
    
    $api->group(['prefix' => 'media'], function (Router $api) {
        
        $api->post('upload-image', 'App\\ACME\\Api\\V1\\Media\\Controllers\\UploadToCategoryController@run');
        
        ############# INCREMENT / DECREMENT #######################
        $api->post('increment', 'App\\ACME\\Api\\V1\\Media\\Controllers\\IncrementScoreController@run');
        $api->post('decrement', 'App\\ACME\\Api\\V1\\Media\\Controllers\\DecrementScoreController@run');
        
    });
    
});
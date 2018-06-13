<?php

use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version('v1', function (Router $api) {
    
    $api->group(['prefix' => 'media'], function (Router $api) {
        
        $api->post('upload-image', 'App\\ACME\\Api\\V1\\Media\\Controllers\\UploadToCategoryController@run')
            ->middleware('role.artist');
        $api->get('user-images', 'App\\ACME\\Api\\V1\\Media\\Controllers\\ListUserImagesController@run')
            ->middleware('role.artist');
        
        ############# INCREMENT / DECREMENT #######################
        $api->post('increment', 'App\\ACME\\Api\\V1\\Media\\Controllers\\ScoreIncrementController@run');
        $api->post('decrement', 'App\\ACME\\Api\\V1\\Media\\Controllers\\ScoreDecrementController@run');
        
    });
    
});
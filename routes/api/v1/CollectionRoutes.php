<?php

use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version('v1', function (Router $api) {
    
    $api->group(['prefix' => 'collection'], function (Router $api) {
        
        $api->post('create', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\CreateCollectionController@run');
        $api->post('upload-image', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\AddMediaToCollectionController@run');
        $api->get('{id}/images', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\AllImagesInCollectionController@run');
        
        ############# INCREMENT / DECREMENT #######################
        $api->post('increment', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\IncrementScoreCollectionController@run');
        $api->post('decrement', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\DecrementScoreCollectionController@run');
        
    });
    
});
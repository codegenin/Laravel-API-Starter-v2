<?php

use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version('v1', function (Router $api) {
    
    $api->group(['prefix' => 'collection'], function (Router $api) {
        
        $api->post('create', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\CreateCollectionController@run');
        $api->get('{id}/images', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\ListImagesController@run');
        
        ############## DISABLED #############################
        $api->post('upload-image', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\AddMediaToCollectionController@run');
        
    });
    
});
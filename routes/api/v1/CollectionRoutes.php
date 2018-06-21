<?php

use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version('v1', function (Router $api) {
    
    $api->group(['prefix' => 'collection'], function (Router $api) {
        
        $api->get('{id}/images', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\ListImagesController@run');
        $api->get('{id}/show', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\ViewCollectionController@run');
        $api->get('{id}/is-user-favorite', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\IsUserFavoriteController@run');
        
        ############## DISABLED #############################
        #$api->post('create', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\CreateCollectionController@run');
        #$api->post('upload-image', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\AddMediaToCollectionController@run');
        
    });
    
});
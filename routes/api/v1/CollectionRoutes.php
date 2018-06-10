<?php

use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version('v1', function (Router $api) {
    
    $api->group(['prefix' => 'collection'], function (Router $api) {
    
        $api->post('new', 'App\\ACME\\Api\\V1\\Collection\\Controllers\\CreateCollectionController@run');
        
    });
    
});
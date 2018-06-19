<?php

use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version('v1', function (Router $api) {
    
    $api->group(['prefix' => 'search'], function (Router $api) {
        
        $api->get('{term}/all', 'App\\ACME\\Api\\V1\\Search\\Controllers\\SearchAllController@run');
        
    });
    
});
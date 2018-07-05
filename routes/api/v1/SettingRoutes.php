<?php

use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version('v1', function (Router $api) {
    
    $api->group(['prefix' => 'setting'], function (Router $api) {
        
        $api->get('price-list', 'App\\ACME\\Api\\V1\\Setting\\Controllers\\PriceListController@run');
        
    });
    
});
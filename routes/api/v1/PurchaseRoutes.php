<?php

use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version('v1', function (Router $api) {
    
    $api->group(['prefix' => 'purchase'], function (Router $api) {
        
        $api->get('{id}/collection', 'App\\ACME\\Api\\V1\\Purchase\\Controllers\\PurchaseCollectionController@run');
    
        $api->get('user-purchases', 'App\\ACME\\Api\\V1\\Purchase\\Controllers\\ListUserPurchasesController@run');
    
    });
});
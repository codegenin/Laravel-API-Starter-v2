<?php

use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version('v1', function (Router $api) {
    
    $api->group(['prefix' => 'category'], function (Router $api) {
        
        $api->get('list-all', 'App\\ACME\\Api\\V1\\Category\\Controllers\\CategoryListsController@listAll');
        $api->get('{id}/show', 'App\\ACME\\Api\\V1\\Category\\Controllers\\CategoryController@show');
        
    });
    
});
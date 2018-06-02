<?php

use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version('v1', function (Router $api) {
    
    $api->group(['prefix' => 'user'], function (Router $api) {
    
        $api->get('me', 'App\\ACME\\Api\\V1\\User\\Controllers\\UserController@me');
        
        $api->post('role-update', 'App\\ACME\\Api\\V1\\User\\Controllers\\RoleController@updateUserRole');
        
        $api->get('{id}/delete', 'App\\ACME\\Api\\V1\\User\\Controllers\\UserController@delete');
        
    });
    
});
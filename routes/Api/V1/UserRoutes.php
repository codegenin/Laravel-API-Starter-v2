<?php

use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version('v1', function (Router $api) {
    
    $api->group(['prefix'     => 'user',
                 'middleware' => 'jwt.auth'
    ], function (Router $api) {
        
        $api->post('role-update', 'App\\ACME\\Api\\V1\\User\\Controllers\\RoleController@updateUserRole');
        
    });
    
});
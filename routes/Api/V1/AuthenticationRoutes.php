<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', function (Router $api) {
    
    $api->group(['prefix' => 'auth'], function (Router $api) {
        $api->post('signup', 'App\\Api\\V1\\Authentication\\Controllers\\SignUpController@signUp');
        $api->post('login', 'App\\Api\\V1\\Authentication\\Controllers\\LoginController@login');
        
        $api->post('recovery', 'App\\Api\\V1\\Authentication\\Controllers\\ForgotPasswordController@sendResetEmail');
        $api->post('reset', 'App\\Api\\V1\\Authentication\\Controllers\\ResetPasswordController@resetPassword');
        
        $api->post('logout', 'App\\Api\\V1\\Authentication\\Controllers\\LogoutController@logout');
        $api->post('refresh', 'App\\Api\\V1\\Authentication\\Controllers\\RefreshController@refresh');
    });
    
});
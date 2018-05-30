<?php

use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version('v1', function (Router $api) {
    
    $api->group(['prefix' => 'auth'], function (Router $api) {
        
        $api->post('register', 'App\\Api\\V1\\Authentication\\Controllers\\RegisterController@register');
        $api->post('login', 'App\\Api\\V1\\Authentication\\Controllers\\LoginController@login');
        
        $api->post('recovery', 'App\\Api\\V1\\Authentication\\Controllers\\ForgotPasswordController@sendResetEmail');
        $api->post('reset', 'App\\Api\\V1\\Authentication\\Controllers\\ResetPasswordController@resetPassword');
        
        $api->post('logout', 'App\\Api\\V1\\Authentication\\Controllers\\LogoutController@logout');
        $api->post('refresh', 'App\\Api\\V1\\Authentication\\Controllers\\RefreshController@refresh');
        
        $api->get('verify/{token}', 'App\\Api\\V1\\Authentication\\Controllers\\VerificationController@verify');
    });
    
});
<?php

use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version('v1', function (Router $api) {
    
    $api->group(['prefix' => 'auth'], function (Router $api) {
        
        $api->post('register', 'App\\ACME\\Api\\V1\\Authentication\\Controllers\\RegisterController@register');
        $api->post('login', 'App\\ACME\\Api\\V1\\Authentication\\Controllers\\LoginController@login')
            ->name('api.login');
        $api->post('social', 'App\\ACME\\Api\\V1\\Authentication\\Controllers\\SocialAuthenticationController@login')
            ->name('api.login.social');
        
        $api->post('recovery',
            'App\\ACME\\Api\\V1\\Authentication\\Controllers\\ForgotPasswordController@sendResetEmail');
        $api->post('reset', 'App\\ACME\\Api\\V1\\Authentication\\Controllers\\ResetPasswordController@resetPassword');
        
        $api->post('logout', 'App\\ACME\\Api\\V1\\Authentication\\Controllers\\LogoutController@logout');
        $api->post('refresh', 'App\\ACME\\Api\\V1\\Authentication\\Controllers\\RefreshController@refresh');
        
        
    });
    
});
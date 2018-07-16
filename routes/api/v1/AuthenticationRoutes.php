<?php

Route::group(['prefix' => 'auth'], function () {
    
    Route::post('register', 'App\\ACME\\Api\\V1\\Authentication\\Controllers\\RegisterController@register');
    Route::post('login', 'App\\ACME\\Api\\V1\\Authentication\\Controllers\\LoginController@login')
        ->name('api.login');
    Route::post('social', 'App\\ACME\\Api\\V1\\Authentication\\Controllers\\SocialAuthenticationController@login')
        ->name('api.login.social');
    
    Route::post('recovery',
        'App\\ACME\\Api\\V1\\Authentication\\Controllers\\ForgotPasswordController@sendResetEmail');
    Route::post('reset', 'App\\ACME\\Api\\V1\\Authentication\\Controllers\\ResetPasswordController@resetPassword');
    
    Route::post('logout', 'App\\ACME\\Api\\V1\\Authentication\\Controllers\\LogoutController@logout');
    Route::post('refresh', 'App\\ACME\\Api\\V1\\Authentication\\Controllers\\RefreshController@refresh');
    
});
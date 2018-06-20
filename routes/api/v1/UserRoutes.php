<?php

use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version('v1', function (Router $api) {
    
    $api->group(['prefix' => 'user'], function (Router $api) {
        
        $api->get('profile', 'App\\ACME\\Api\\V1\\User\\Controllers\\UserProfileController@run');
        
        $api->post('role-update', 'App\\ACME\\Api\\V1\\User\\Controllers\\RoleController@updateUserRole');
        $api->post('profile-update', 'App\\ACME\\Api\\V1\\User\\Controllers\\UpdateProfileController@run');
        $api->post('about-update', 'App\\ACME\\Api\\V1\\User\\Controllers\\UpdateAboutController@run');
        $api->post('avatar-update', 'App\\ACME\\Api\\V1\\User\\Controllers\\UpdateAvatarController@run');
        
        $api->get('{id}/delete', 'App\\ACME\\Api\\V1\\User\\Controllers\\UserController@delete');
        
        ########### ARTIST ROUTES ######################
        $api->get('artist/{id}/show', 'App\\ACME\\Api\\V1\\User\\Controllers\\ViewArtistController@run');
        
    });
    
});
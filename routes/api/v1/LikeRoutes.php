<?php

use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version('v1', function (Router $api) {
    
    $api->group(['prefix' => 'like'], function (Router $api) {
        
        $api->get('{id}/image', 'App\\ACME\\Api\\V1\\Like\\Controllers\\LikeMediaController@run');
    
        $api->get('user-likes', 'App\\ACME\\Api\\V1\\Like\\Controllers\\ListUserLikesController@run');
        $api->get('user-book', 'App\\ACME\\Api\\V1\\Like\\Controllers\\ListUserBooksController@run');
        $api->get('{id}/remove-book', 'App\\ACME\\Api\\V1\\Like\\Controllers\\RemoveBookMediaController@run');
    
    });
});
<?php

use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version('v1', function (Router $api) {
    
    $api->group(['prefix' => 'favorite'], function (Router $api) {
        
        $api->get('{id}/category', 'App\\ACME\\Api\\V1\\Favorite\\Controllers\\SetCategoryAsFavoriteController@run');
        $api->get('{id}/collection', 'App\\ACME\\Api\\V1\\Favorite\\Controllers\\SetCollectionAsFavoriteController@run');
        $api->get('user-favorites', 'App\\ACME\\Api\\V1\\Favorite\\Controllers\\ListUserFavoritesController@run');
        
    });
    
});
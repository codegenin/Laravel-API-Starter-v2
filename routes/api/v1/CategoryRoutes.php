<?php

use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version('v1', function (Router $api) {
    
    $api->group(['prefix' => 'category'], function (Router $api) {
        
        $api->get('list-all', 'App\\ACME\\Api\\V1\\Category\\Controllers\\ListCategoryController@run');
        $api->get('{id}/show', 'App\\ACME\\Api\\V1\\Category\\Controllers\\ViewCategoryController@run');
        $api->get('{id}/collections', 'App\\ACME\\Api\\V1\\Category\\Controllers\\ListCollectionsController@run');
        $api->get('{id}/images', 'App\\ACME\\Api\\V1\\Category\\Controllers\\ListImagesController@run');
        $api->get('{id}/is-user-favorite', 'App\\ACME\\Api\\V1\\Category\\Controllers\\IsUserFavoriteController@run');
        
        ################ FILTERED BY DATE ####################################
        $api->get('{id}/images/day',
            'App\\ACME\\Api\\V1\\Category\\Controllers\\FilterImagesByDayController@run');
        $api->get('{id}/images/week',
            'App\\ACME\\Api\\V1\\Category\\Controllers\\FilterImagesByWeekController@run');
        $api->get('{id}/images/month',
            'App\\ACME\\Api\\V1\\Category\\Controllers\\FilteImagesByMonthController@run');
        
        ################ COLLECTION RANDOM OR RECENT ############################
        $api->get('{id}/recent-collections',
            'App\\ACME\\Api\\V1\\Category\\Controllers\\CollectionsRecentController@run');
        $api->get('{id}/random-collections',
            'App\\ACME\\Api\\V1\\Category\\Controllers\\CollectionsRandomController@run');
        
        ################ ARCHIVE OR RECENT ############################
        $api->get('{id}/archive-images',
            'App\\ACME\\Api\\V1\\Category\\Controllers\\ImagesArchiveController@run');
        $api->get('{id}/recent-images',
            'App\\ACME\\Api\\V1\\Category\\Controllers\\ImagesRecentController@run');
    });
    
});
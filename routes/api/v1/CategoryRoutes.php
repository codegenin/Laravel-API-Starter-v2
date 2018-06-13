<?php

use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version('v1', function (Router $api) {
    
    $api->group(['prefix' => 'category'], function (Router $api) {
        
        $api->get('list-all', 'App\\ACME\\Api\\V1\\Category\\Controllers\\ListCategoryController@run');
        $api->get('{id}/show', 'App\\ACME\\Api\\V1\\Category\\Controllers\\ShowCategoryController@run');
        $api->get('{id}/collections', 'App\\ACME\\Api\\V1\\Category\\Controllers\\ListCollectionsController@run');
        $api->get('{id}/images', 'App\\ACME\\Api\\V1\\Category\\Controllers\\ListImagesController@run');
        
        ################ FILTERED BY DATE ####################################
        $api->get('{id}/collections/day',
            'App\\ACME\\Api\\V1\\Category\\Controllers\\FilterCollectionsByDayController@run');
        $api->get('{id}/collections/week',
            'App\\ACME\\Api\\V1\\Category\\Controllers\\FilterCollectionsByWeekController@run');
        $api->get('{id}/collections/month',
            'App\\ACME\\Api\\V1\\Category\\Controllers\\FilterCollectionByMonthController@run');
        
        ################ ARCHIVE OR RECENT ############################
        $api->get('{id}/archive-images',
            'App\\ACME\\Api\\V1\\Category\\Controllers\\ImagesArchiveController@run');
        $api->get('{id}/recent-images',
            'App\\ACME\\Api\\V1\\Category\\Controllers\\ImageRecentController@run');
    });
    
});
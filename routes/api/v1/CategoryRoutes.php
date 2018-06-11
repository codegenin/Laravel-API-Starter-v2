<?php

use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version('v1', function (Router $api) {
    
    $api->group(['prefix' => 'category'], function (Router $api) {
        
        $api->get('list-all', 'App\\ACME\\Api\\V1\\Category\\Controllers\\AllCategoryController@run');
        $api->get('{id}/show', 'App\\ACME\\Api\\V1\\Category\\Controllers\\ShowCategoryController@run');
        $api->get('{id}/collections', 'App\\ACME\\Api\\V1\\Category\\Controllers\\CollectionCategoryController@run');
        $api->get('{id}/images', 'App\\ACME\\Api\\V1\\Category\\Controllers\\AllImagesInCategoryController@run');
        
        $api->post('upload-image', 'App\\ACME\\Api\\V1\\Category\\Controllers\\AddMediaToCategoryController@run');
        
        ################ BY DATE ####################################
        $api->get('{id}/collections/day',
            'App\\ACME\\Api\\V1\\Category\\Controllers\\DayCollectionsCategoryController@run');
        $api->get('{id}/collections/week',
            'App\\ACME\\Api\\V1\\Category\\Controllers\\WeekCollectionsCategoryController@run');
        $api->get('{id}/collections/month',
            'App\\ACME\\Api\\V1\\Category\\Controllers\\MonthCollectionsCategoryController@run');
    });
    
});
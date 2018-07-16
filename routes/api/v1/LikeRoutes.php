<?php
Route::group(['prefix' => 'like'], function () {
    
    Route::get('{id}/image', 'App\\ACME\\Api\\V1\\Like\\Controllers\\LikeMediaController@run');
    
    Route::get('user-likes', 'App\\ACME\\Api\\V1\\Like\\Controllers\\ListUserLikesController@run');
    Route::get('user-book', 'App\\ACME\\Api\\V1\\Like\\Controllers\\ListUserBooksController@run');
    Route::get('{id}/remove-book', 'App\\ACME\\Api\\V1\\Like\\Controllers\\RemoveBookMediaController@run');
    
});
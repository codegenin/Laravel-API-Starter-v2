<?php

Route::group(['prefix' => 'user'], function () {
    
    Route::get('profile', 'App\\ACME\\Api\\V1\\User\\Controllers\\UserProfileController@run');
    Route::get('{id}/show', 'App\\ACME\\Api\\V1\\User\\Controllers\\ViewUserController@run');
    
    Route::post('role-update', 'App\\ACME\\Api\\V1\\User\\Controllers\\RoleController@updateUserRole');
    Route::post('profile-update', 'App\\ACME\\Api\\V1\\User\\Controllers\\UpdateProfileController@run');
    Route::post('about-update', 'App\\ACME\\Api\\V1\\User\\Controllers\\UpdateAboutController@run');
    Route::post('avatar-update', 'App\\ACME\\Api\\V1\\User\\Controllers\\UpdateAvatarController@run');
    
    Route::get('{id}/delete', 'App\\ACME\\Api\\V1\\User\\Controllers\\UserController@delete');
    
    ########### ARTIST ROUTES ######################
    Route::get('artist/{id}/show', 'App\\ACME\\Api\\V1\\User\\Controllers\\ViewArtistController@run');
    Route::get('artist/{id}/is-user-favorite', 'App\\ACME\\Api\\V1\\User\\Controllers\\IsUserFavoriteController@run');
    
    Route::post('add-points', 'App\\ACME\\Api\\V1\\User\\Controllers\\AddUserMediaPointsController@run');
    
    
});
    
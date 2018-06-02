<?php

Route::group(['prefix' => 'auth'], function () {
    
    Route::get('login', 'App\ACME\Admin\Authentication\Controllers\LoginController@showLoginForm')
         ->name('admin.auth.get.login');
    Route::post('login', 'App\ACME\Admin\Authentication\Controllers\LoginController@login')
         ->name('admin.auth.post.login');
    
    Route::post('logout', 'App\ACME\Admin\Authentication\Controllers\LogoutController@logout')
         ->name('admin.auth.post.logout');
    
});
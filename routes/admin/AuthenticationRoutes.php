<?php

Route::group(['prefix' => 'auth'], function () {
    
    Route::get('login', 'App\\ACME\\Admin\\Authentication\\Controllers\\LoginController@login')
         ->name('admin.auth.login');
    
});
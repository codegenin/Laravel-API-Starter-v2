<?php

Route::get('dashboard', 'App\ACME\Admin\Dashboard\Controllers\DashboardController@index')
     ->name('admin.dashboard');

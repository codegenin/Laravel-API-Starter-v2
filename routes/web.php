<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\UploadedFile;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*Route::get('test', function() {
    $faker = \Faker\Factory::create();
    $image = $faker->imageUrl(500, 500, 'cats', true, 'SAMPLE ONLY');
    echo $image;
});*/

Route::get('reset_password/{token}', [
    'as' => 'password.reset',
    function ($token) {
        // implement your reset password route here!
    }
]);

Route::get('verify/{token}', 'App\\ACME\\Web\\Authentication\\Controllers\\VerificationController@verify')
     ->name('verify.user');

Route::get('/', function () {
    return view('welcome');
});



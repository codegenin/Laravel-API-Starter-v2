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

Route::get('reset_password/{token}',
    'App\\ACME\\Web\\Authentication\\Controllers\\ResetPasswordController@showResetForm')
     ->name('password.reset');

Route::post('reset_password/update',
    'App\\ACME\\Web\\Authentication\\Controllers\\ResetPasswordController@reset')
     ->name('password.update');

Route::get('reset/success',
    'App\\ACME\\Web\\Authentication\\Controllers\\ResetPasswordController@resetSuccess')
     ->name('password.success');

Route::get('verify/{token}', 'App\\ACME\\Web\\Authentication\\Controllers\\VerificationController@verify')
     ->name('verify.user');


Route::get('/', function () {
    return view('welcome');
});


############# Terms and Policy ####################
Route::get('terms-of-use', 'App\\ACME\\Web\\Misc\\Controllers\\TermsOfUseController@english')
    ->name('misc.terms_of_user_en');

Route::get('fr/terms-of-use', 'App\\ACME\\Web\\Misc\\Controllers\\TermsOfUseController@french')
    ->name('misc.terms_of_user_fr');

Route::get('privacy-policy', 'App\\ACME\\Web\\Misc\\Controllers\\PrivacyPolicyController@show')
     ->name('misc.privacy_policy');

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "frontend" middleware group. Now create something great!
|
*/
//------------------------------------------------------------------------------------
Route::any('/', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);
Route::post('/update-lang', [
    'as' => 'update.lang',
    'uses' => '\App\Http\Supports\TransController@updateLang'
]);
Route::get('/logs', '\App\Http\Supports\LogViewerController@index')->middleware('log.viewer')->name('frontend.log.viewer');
Route::get('/switch-lang/{lang}', [
    'as' => 'frontend.switch_lang',
    'uses' => '\App\Http\Supports\TransController@switchLang'
]);

Route::post('/register_user', [
    'as' => 'register_user.ajaxRegisterUser',
    'uses' => 'RegisterController@ajaxRegisterUser'
]);
Route::any('/logout', [
    'as' => 'frontend.logout',
    'uses' => 'Auth\LoginController@logout'
]);

Route::get('/login-facebook', ['as' => 'auth.login.facebook', 'uses' => 'Auth\LoginController@loginFacebook']);
Route::get('/login-google', ['as' => 'auth.login.google', 'uses' => 'Auth\LoginController@loginGoogle']);
Route::get('/login-twitter', ['as' => 'auth.login.twitter', 'uses' => 'Auth\LoginController@loginTwitter']);
Route::get('/login-facebook-callback', ['as' => 'auth.login.facebook_callback', 'uses' => 'Auth\LoginController@loginFacebookCallback']);
Route::get('/login-google-callback', ['as' => 'auth.login.google_callback', 'uses' => 'Auth\LoginController@loginGoogleCallback']);
Route::get('/login-twitter-callback', ['as' => 'auth.login.twitter_callback', 'uses' => 'Auth\LoginController@loginTwitterCallback']);
// application

Route::middleware(['auth.frontend'])->group(function () {
    Route::get('/applications/presents', ['as' => 'application.presents', 'uses' => 'ApplicationsController@displayMyPage']);

    Route::post('/confirm-play-game/{id}', ['as' => 'application.confirm.play.game', 'uses' => 'ApplicationsController@confirmPlayGame']);

    Route::middleware('throttle:' . getConfig('throttle.times') . ',' . getConfig('throttle.minute'))->group(function () {
        Route::post('/play-game/{id}', ['as' => 'application.play.game', 'uses' => 'ApplicationsController@playGame']);
    });

    Route::get('/my-page', ['as' => 'my_page', 'uses' => 'ApplicationsController@displayMyPage']);

    Route::post('/ship/address', ['as' => 'address_ship', 'uses' => 'ShippingController@ajaxUpdateAddressShipUser']);
});

Route::middleware('throttle:' . getConfig('throttle.times') . ',' . getConfig('throttle.minute'))->group(function () {
    Route::get('/{serial}/{key}', ['as' => 'application.apply.serial', 'uses' => 'ApplicationsController@applySerial'])->where('serial', '[0-9]+');
});

Route::get('/terms', ['as' => 'term', 'uses' => 'ApplicationsController@displayTerms']);
Route::get('/privacypolicy', ['as' => 'privacypolicy', 'uses' => 'ApplicationsController@displayPolicy']);
Route::get('/shops', ['as' => 'list-store', 'uses' => 'ListStoreController@displayListStore']);

authRoutes('frontend');
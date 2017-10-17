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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group( function(){
	Route::get('/', 'AdminController@index')->name('admin.dashboard');
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

});




/*facebook socialite*/
Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

/*twitter socialite*/
Route::get('login/twitter', 'Auth\LoginController@twitterRedirectToProvider');
Route::get('login/twitter/callback', 'Auth\LoginController@twitterHandleProviderCallback');

/*google socialite*/
Route::get('login/google', 'Auth\LoginController@googleRedirectToProvider');
Route::get('login/google/callback', 'Auth\LoginController@googleHandleProviderCallback');


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

if (Request::ip() === "::1") {
    Route::get('/robertsworkspace/', 'HomeController@index');
    Route::get('/robertsworkspace/index', 'HomeController@index');
    Route::get('/robertsworkspace/contact', 'ContactController@index');
    Route::get('/robertsworkspace/projects', 'ProjectsController@index');
    Route::get('/robertsworkspace/privacy', 'PrivacyController@index');
    Route::get('/robertsworkspace/github', 'GithubController@index');
    Route::get('/robertsworkspace/ipdata', 'IPDataController@index');
    Route::get('/robertsworkspace/dashboard', 'DashboardController@index');
    Route::post('/robertsworkspace/sendmail', 'SendmailController@index');
    Route::get('/robertsworkspace/signin', 'SignInController@index');
    Route::post('/robertsworkspace/signin', 'SignInController@index');
    Route::get('/robertsworkspace/signout', 'SignOutController@index');
} else {
    Route::get('', 'HomeController@index');
    Route::get('/index', 'HomeController@index');
    Route::get('/contact', 'ContactController@index');
    Route::get('/projects', 'ProjectsController@index');
    Route::get('/privacy', 'PrivacyController@index');
    Route::get('/github', 'GithubController@index');
    Route::get('/ipdata', 'IPDataController@index');
    Route::get('/dashboard', 'DashboardController@index');
    Route::post('/sendmail', 'SendmailController@index');
    Route::get('/signin', 'SignInController@index');
    Route::post('/signin', 'SignInController@index');
    Route::get('/signout', 'SignOutController@index');
}

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

Route::get('/robertsworkspace/', 'HomeController@index');
Route::get('/robertsworkspace/contact', 'ContactController@index');
Route::get('/robertsworkspace/projects', 'ProjectsController@index');
Route::get('/robertsworkspace/privacy', 'PrivacyController@index');
Route::get('/robertsworkspace/github', 'GithubController@index');
Route::get('/robertsworkspace/ipdata', 'IPDataController@index');
Route::get('/robertsworkspace/dashboard', 'DashboardController@index');

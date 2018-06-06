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
    Route::get('/robertsworkspace/', 'PortfolioController@home');
    Route::get('/robertsworkspace/index', 'PortfolioController@home');
    Route::get('/robertsworkspace/contact', 'PortfolioController@contact');
    Route::get('/robertsworkspace/projects', 'PortfolioController@projects');
    Route::get('/robertsworkspace/privacy', 'PortfolioController@privacy');
    Route::get('/robertsworkspace/github', 'GithubController@index');
    Route::get('/robertsworkspace/ipdata', 'PortfolioController@ipdata');
    Route::get('/robertsworkspace/dashboard', 'PortfolioController@dashboard');
    Route::post('/robertsworkspace/sendmail', 'PortfolioController@sendmail');
    Route::get('/robertsworkspace/admin', 'AdminController@index');
    Route::get('/robertsworkspace/signin', 'AdminController@signin');
    Route::post('/robertsworkspace/signin', 'AdminController@signin');
    Route::get('/robertsworkspace/signout', 'AdminController@signout');
    Route::get('/robertsworkspace/projects', 'ProjectsController@index');
    Route::get('/robertsworkspace/projects/create', 'ProjectsController@create');
    Route::post('/robertsworkspace/projects', 'ProjectsController@store');
    Route::delete('/robertsworkspace/projects/{id}', 'ProjectsController@destroy');
    Route::get('/robertsworkspace/projects/{id}/edit', 'ProjectsController@edit');
} else {
    Route::get('', 'PortfolioController@home');
    Route::get('/index', 'PortfolioController@home');
    Route::get('/contact', 'PortfolioController@contact');
    Route::get('/projects', 'PortfolioController@projects');
    Route::get('/privacy', 'PortfolioController@privacy');
    Route::get('/github', 'GithubController@index');
    Route::get('/ipdata', 'PortfolioController@ipdata');
    Route::get('/dashboard', 'PortfolioController@dashboard');
    Route::post('/sendmail', 'PortfolioController@sendmail');
    Route::get('/robertsworkspace/admin', 'AdminController@index');
    Route::get('/signin', 'AdminController@signin');
    Route::post('/signin', 'AdminController@signin');
    Route::get('/signout', 'AdminController@signout');
    Route::get('/projects', 'ProjectsController@index');
    Route::get('/projects/create', 'ProjectsController@create');
    Route::post('/projects', 'ProjectsController@store');
}

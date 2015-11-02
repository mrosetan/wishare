<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/* Initial pages */
Route::get('/', 'PagesController@index');
Route::get('/signin', 'PagesController@signin');
Route::get('/signup', 'PagesController@signup');
Route::get('/blank', 'PagesController@blank');

/* User */
Route::get('user/usermaster', 'UserController@dashboard');
Route::get('user/home', 'UserController@home');
Route::get('user/profile', 'UserController@profile');

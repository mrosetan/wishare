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
Route::get('user/notifications', 'UserController@notifications');

// ADMIN
Route::get('/admin', 'AdminController@index');
Route::get('/admin/reports', 'AdminController@reports');
Route::get('/admin/create/admin', 'AdminController@createAdmin');
Route::get('/admin/create/defaultwishlist', 'AdminController@createDefaultWishlist');
Route::get('/admin/view/admins', 'AdminController@showAdmins');
Route::get('/admin/view/defaultwishlists', 'AdminController@viewDefaultWishlists');
Route::get('/admin/monitor/users', 'AdminController@monitorUsers');
Route::get('/admin/monitor/wishes', 'AdminController@monitorWishes');
Route::get('/admin/monitor/wishlists', 'AdminController@monitorWishlists');
Route::get('/admin/edit/{id?}', 'AdminController@editAdmin');

Route::post('/admin/edit/{id?}', 'AdminController@updateAdmin');
Route::post('/admin/create/admin', 'AdminController@storeAdmin');
Route::get('/admin/delete/{id?}', 'AdminController@deleteAdmin');

// Auth
Route::post('/auth/signin', 'AuthController@signin');
Route::post('/auth/signup', 'AdminController@store');
Route::get('/auth/signout', 'AuthController@signout');

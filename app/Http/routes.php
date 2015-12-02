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
Route::get('/reactivate', 'PagesController@activateAccount');
Route::get('/blank', 'PagesController@blank');


/* User */
Route::get('user/usermaster', 'UserController@dashboard');
Route::get('user/home', 'UserController@home');
Route::get('user/profile', 'UserController@getUserDetails');
Route::get('user/profile/wishlists', 'UserController@getWishlist');
Route::post('user/profile/{id?}', 'UserController@updateWishlist');
Route::get('user/profile/{id?}', 'UserController@deleteWishlist');
Route::get('user/notifications', 'UserController@notifications');
Route::get('user/action/wishlist{id?}', 'UserController@wishlistAction');
Route::post('user/action/wishlist/{id?}', 'UserController@createWishlist');
Route::get('user/action/wish', 'UserController@wishAction');
Route::get('user/action/notes', 'UserController@getNoteRecipient');
Route::post('user/action/notes', 'UserController@createNote');
Route::post('user/action/tynotes', 'UserController@createTYNote');
Route::get('user/action/tynotes', 'UserController@getTYNoteRecipient');
Route::get('user/notes', 'UserController@notes');
Route::get('user/wish/{id?}', 'UserController@wish');
Route::get('user/notes', 'UserController@getNote');
Route::get('user/notes', 'UserController@getTYNote');
// Route::get('user/notes', 'UserController@outbox');
Route::post('user/notes/{id?}', 'UserController@createNoteModal');
Route::get('user/notes/{id?}', 'UserController@deleteNote');
Route::get('user/notes/{id?}', 'UserController@deleteTYNote');
Route::get('user/settings/deactivate', 'UserController@deactivate');
Route::get('user/help', 'UserController@help');
Route::get('user/setPassword', 'UserController@setPassword');
Route::post('user/setPassword', 'UserController@updateToSetPassword');
Route::get('user/settings/changepassword', 'UserController@changepass');
Route::post('user/settings/changepassword', 'UserController@changeAccountPassword');
Route::get('user/settings/{id?}', 'UserController@editSettings');
Route::post('user/settings/{id?}', 'UserController@updateUserSettings');
Route::post('user/settings/profilePic/{id?}', 'UserController@updateProfilePic');
/* Other user */
Route::get('otheruser/{id?}', 'UserController@otheruser');

Route::get('user/search', 'UserController@search');
Route::post('user/search', 'UserController@search');

Route::get('user/add/{id?}', 'UserController@addFriend');
Route::get('user/unfriend/{id?}', 'UserController@unfriend');
Route::get('user/cancelFriendRequest/{id?}', 'UserController@cancelFriendRequest');
Route::get('user/accept/{id?}', 'UserController@acceptFriendRequest');
Route::get('user/decline/{id?}', 'UserController@declineFriendRequest');

Route::post('user/add', 'UserController@addWish');
Route::post('user/add/{id?}', 'UserController@addWishModal');
Route::get('user/edit/tags/{id?}', 'UserController@editTags');
Route::post('user/edit/tags/{id?}', 'UserController@updateTags');
Route::post('user/edit/wish/{id?}', 'UserController@updateWish');
Route::get('user/delete/wish/{id?}', 'UserController@deleteWish');



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
Route::get('/admin/deactivateUser/{id?}', 'AdminController@deactivateUser');

Route::post('/admin/edit/{id?}', 'AdminController@updateAdmin');
Route::post('/admin/create/admin', 'AdminController@storeAdmin');
Route::get('/admin/delete/{id?}', 'AdminController@deleteAdmin');

Route::post('/admin/create/defaultwishlist', 'AdminController@storeDefaultWishlist');
Route::get('/admin/edit/defaultwishlist/{id?}', 'AdminController@editDefaultWishlist');
Route::post('/admin/edit/defaultwishlist/{id?}', 'AdminController@updateDefaultWishlist');
Route::get('/admin/delete/defaultwishlist/{id?}', 'AdminController@deleteDefaultWishlist');

Route::get('/admin/search', 'AdminController@searchUserOrAdmin');

Route::get('/admin/deactivate/{id?}', 'AdminController@deactivate');
Route::get('/admin/reactivate/{id?}', 'AdminController@reactivate');

// Route::get('/admin/search', 'AdminController@search');
// Route::post('/admin/search', 'AdminController@searchUser');

// Auth
Route::post('/auth/signin', 'AuthController@signin');
// Route::post('/auth/signup', 'UserController@store');
Route::post('/auth/signup', 'AuthController@store');
Route::get('/auth/signout', 'AuthController@signout');

//Social Login

Route::get('login/facebook', 'AuthController@redirectToProvider');
Route::get('/login/facebook/callback','AuthController@handleProviderCallback');

// Route::get('/login/{provider?}',[
//     'uses' => 'AuthController@getSocialAuth',
//     'as'   => 'auth.getSocialAuth'
// ]);
//
//
// Route::get('/login/callback/{provider?}',[
//     'uses' => 'AuthController@getSocialAuthCallback',
//     'as'   => 'auth.getSocialAuthCallback'
// ]);

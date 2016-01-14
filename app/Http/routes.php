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

// Profile
Route::get('/profilemaster', 'ProfileController@profile');
Route::get('/profile', 'ProfileController@wishlists');
Route::get('profile/friends', 'ProfileController@friends');
Route::get('profile/wishes/{id?}', 'WishlistController@wishes');
Route::get('profile/wishlists', 'ProfileController@wishWishlists');
Route::get('profile/granted', 'ProfileController@granted');
Route::get('profile/given', 'ProfileController@given');
Route::get('profile/tracked', 'ProfileController@tracked');
Route::get('profile/tynotes', 'ProfileController@tynotes');
Route::get('profile/tynotes/{id?}', 'ProfileController@deleteTYNoteProfile');
Route::post('profile/wish/edit/{id?}', 'UserController@updateWish');
Route::get('profile/wish/edit/{id?}', 'UserController@updateWishDetails');

//other user new
Route::get('othermaster/{id?}', 'OtherUserController@master');
Route::get('other/{id?}', 'OtherUserController@profile');
Route::get('other/profile/{id?}', 'OtherUserController@wishlists');
Route::get('other/wishlists/{id?}', 'OtherUserController@wishWishlists');
Route::get('other/granted/{id?}', 'OtherUserController@granted');
Route::get('other/given/{id?}', 'OtherUserController@given');
Route::get('other/tracked/{id?}', 'OtherUserController@tracked');
Route::get('other/friends/{id?}', 'OtherUserController@friends');
Route::get('other/tynotes/{id?}', 'OtherUserController@tynotes');
// Route::get('other/wishes/{id?}', 'OtherUserController@wishes');
Route::get('other/{id}/wishes/{wishlistid?}', 'OtherWishlistController@wishes');
Route::get('other/profile/add/{id?}', 'OtherUserController@privateUser');


// Other User old
Route::get('otheruser/{id?}', 'UserController@otheruser');
Route::post('otheruser/{id?}', 'UserController@reWishOtherUser');

/* User */
Route::get('user/w', 'UserController@postSignup');
Route::get('user/usermaster', 'UserController@dashboard');
Route::get('user/home', 'UserController@home');
Route::post('user/grant/{id?}', 'UserController@grantWish');
Route::get('user/grant/accept/{id?}', 'UserController@confirmGrantRequest');
Route::get('user/grant/decline/{id?}', 'UserController@declineGrantRequest');
Route::get('user/profile', 'UserController@getUserDetails');
Route::get('user/profile/wishlists', 'UserController@getWishlist');
Route::post('user/profile/{id?}', 'UserController@updateWishlist');
Route::get('profile/wishlists/delete/{id?}', 'UserController@deleteWishlist');
Route::get('user/profile/{id?}', 'UserController@deleteTYNoteProfile');
Route::get('user/notifications', 'UserController@notifications');
Route::get('user/action/wishlist{id?}', 'UserController@wishlistAction');
Route::post('user/action/wishlist/{id?}', 'UserController@createWishlist');
Route::get('user/action/wish', 'UserController@wishAction');
Route::get('user/action/notes', 'UserController@getNoteRecipient');
Route::post('user/action/notes', 'UserController@createNote');
Route::post('user/action/tynotes', 'UserController@createTYNote');
Route::get('user/action/tynotes', 'UserController@getTYNoteRecipient');
Route::get('user/notes', 'UserController@notes');
Route::get('user/notes', 'UserController@notes');
Route::get('user/wish/{id?}', 'UserController@wish');
Route::get('user/wish/rewish/{id?}', 'UserController@rewishDetails');
Route::post('user/wish/rewish/{id?}', 'UserController@reWish');
Route::get('user/notes', 'UserController@getAllNotes');
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
Route::get('user/delete/wish/{id?}', 'UserController@deleteWish');

Route::get('user/setup', 'UserController@setUsernameAndPassword');

Route::post('favorite', 'FavetrackController@favorite');
Route::post('unfavorite', 'FavetrackController@unfavorite');

Route::post('trackwish', 'FavetrackController@trackwish');
Route::post('untrackwish', 'FavetrackController@untrackwish');

Route::get('wish/{id?}', 'SoloWishController@wish');
Route::get('guest/wish/{id?}', 'SoloWishController@guest');
Route::get('guest/wish/{id?}', 'WishlistController@guest');
Route::get('guest/wishlist/{id?}', 'OtherWishlistController@guest');

// ADMIN
Route::get('/admin', 'AdminController@index');
Route::get('/admin/stats', 'AdminController@stats');
Route::get('/admin/report', 'AdminController@report');
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

// Route::get('/admin/search', 'AdminController@searchUserOrAdmin');
Route::get('admin/search', 'AdminController@search');
Route::post('admin/search', 'AdminController@search');

Route::get('/admin/deactivate/{id?}', 'AdminController@deactivate');
Route::get('/admin/reactivate/{id?}', 'AdminController@reactivate');

Route::get('admin/wuser/{id?}', 'AdminController@userdetails');

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

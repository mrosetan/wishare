<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\SettingRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\SetPasswordRequest;
use App\Http\Requests\AccountPasswordRequest;
use App\Http\Requests\WishlistRequest;
use App\Http\Requests\WishRequest;
use App\Http\Requests\RewishRequest;
use App\Http\Requests\GrantWishRequest;
use App\Http\Requests\NotesRequest;
use App\Http\Requests\FriendRequest;
use App\Http\Requests\TagRequest;
use App\Wishlist;
use App\Wish;
use App\Tag;
use App\User;
use App\DefaultWishlist;
use App\Friend;
use App\Notes;
use Input;
use Image;
use Session;
use Hash;
use Auth;
use Redirect;
use DB;
use Validator;

class ProfileController extends Controller
{
  public function profile()
  {
    $user = Auth::user();
    return view('userlayouts-master.profile-master', compact('user'));
  }

  public function wishlists()
  {
    $user = Auth::user();
    $userId = $user['id'];

    $wishlistsList = Wishlist::with('user')
                        ->where('createdby_id', '=', $userId)
                        ->where('status', '=', 1)
                        ->orderBy('created_at', 'desc')
                        ->lists('title', 'id');

    $wishes = Wish::with('wishlist')->where('createdby_id', '=', $userId)->where('status', '=', 1)->orderBy('created_at', 'desc')->take(5)->get();

    return view('profile.profile-wishlists', compact('user', 'wishes', 'wishlistsList'));
  }

  public function friends()
  {
    $user = Auth::user();
    $userId = $user->id;

    $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
    $friends = User::find($userId)->friends;

    return view('profile.profile-friends', compact('user', 'friends'));
  }

  public function wishes($id)
  {
    $user = Auth::user();
    $userId = $user['id'];

    $wishlists = Wishlist::with('wishes')
                          ->where('id', '=', $id)
                          ->where('createdby_id', '=', $userId)
                          ->where('status', '=', 1)
                          ->orderBy('created_at', 'desc')->get();

    return view('profile.profile-wishes', compact('user', 'wishlists'));
  }
}

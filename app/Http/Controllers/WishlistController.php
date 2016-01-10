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
use App\FavoriteTrack;
use Input;
use Image;
use Session;
use Hash;
use Auth;
use Redirect;
use DB;
use Validator;


class WishlistController extends Controller
{
  public function wishes($id)
  {
    $user = Auth::user();
    $userId = $user['id'];

    $wishlists = Wishlist::with('wishes')
                          ->where('id', '=', $id)
                          ->where('createdby_id', '=', $userId)
                          ->where('status', '=', 1)
                          ->orderBy('created_at', 'desc')
                          ->get();

    return view('profile.profile-wishes', compact('user', 'wishlists'));
  }
}

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

class SoloWishController extends Controller
{

    public function wish($id)
    {
      $user = Auth::user();

      if(!empty($user))
      {
        $userId = $user->id;
        $wish = Wish::with('granter', 'wishlist', 'user')->where('id', '=', $id)->first();
        // dd($wish);
        if (!empty($wish)) {
          $wish['favorited'] = '';

          $wish['faves'] = '';

          $wish['tracked'] = '';

          $wish['tracks'] = '';

          $wish['favorited'] = FavoriteTrack::where('wishid', $wish->id)
                                              ->where('userid', $userId)
                                              ->where('type', 2)
                                              ->first();

          $wish['faves'] = FavoriteTrack::where('wishid', '=', $wish->id)
                                ->where('type', '=', 2)
                                ->count();

          $wish['tracked'] = FavoriteTrack::where('wishid', $wish->id)
                                              ->where('userid', $userId)
                                              ->where('type', 1)
                                              ->first();

          $wish['tracks'] = FavoriteTrack::where('wishid', '=', $wish->id)
                                ->where('type', '=', 1)
                                ->count();
        }

        $grant = Wish::where('id', '=', $id)->get();
        $tags = Tag::with('user')->where('wishid', '=', $id)->get();
        $wishlists = Wishlist::with('wishes')->where('createdby_id', '=', $userId)->where('status', '=', 1)
                          ->orderBy('created_at', 'desc')->get();

        $checkfriends = 0;
        if ($wish->createdby_id != $userId) {
          $checkfriends = 1;
          $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
          $friends = User::find($userId)->friends;

          foreach ($friends as $f) {
            if($f->id == $wish->createdby_id)
            {
              $checkfriends = 2;
            }
          }
        }
        // dd($checkfriends);
        // dd($wish);

        return view('pages.wish', compact('wish', 'tags', 'wishlists', '$checkfriends', 'grant', 'user'));
      }
      else {
        return redirect()->action('SoloWishController@guest', [$id]);
      }

    }

    public function guest($id)
    {

      $wish = Wish::with('granter', 'wishlist', 'user')->where('id', '=', $id)->first();

      if (!empty($wish)) {

        $wish['faves'] = '';

        $wish['tracks'] = '';

        $wish['faves'] = FavoriteTrack::where('wishid', '=', $wish->id)
                              ->where('type', '=', 2)
                              ->count();

        $wish['tracks'] = FavoriteTrack::where('wishid', '=', $wish->id)
                              ->where('type', '=', 1)
                              ->count();
      }

      $grant = Wish::where('id', '=', $id)->get();

      $tags = Tag::with('user')->where('wishid', '=', $id)->get();
      // dd($wish);
      return view('pages.wish-guest', compact('wish', 'tags', 'grant', 'user'));
    }
}

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

    $wishes = Wish::with('wishlist')
                  ->where('createdby_id', '=', $userId)
                  ->where('status', '=', 1)
                  ->orderBy('created_at', 'desc')
                  ->take(5)
                  ->get();

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
                          ->orderBy('created_at', 'desc')
                          ->get();

    return view('profile.profile-wishes', compact('user', 'wishlists'));
  }

  public function granted()
  {
    $user = Auth::user();
    $userId = $user->id;


    $granted = Wish::with('wishlist')
              ->where('createdby_id', '=', $userId)
              ->where('granted', '=', 1)
              ->where('status', '=', 1)
              ->orderBy('created_at')
              ->get();

    if(!empty($granted))
    {
      for($i=0; $i < count($granted); $i++) {
        $granter = User::where('id', '=', $granted[$i]['granterid'])->where('status', '=', 1)->first();
        if(!empty($granter))
          $granted[$i]['granter'] = $granter;
      }

      foreach ($granted as $g) {
        $g['favorited'] = '';
        $g['faves'] = '';
        $g['tracked'] = '';
        $g['tracks'] = '';

        $g['favorited'] = FavoriteTrack::where('wishid', $g->id)
                                            ->where('userid', $userId)
                                            ->where('type', 2)
                                            ->first();

        $g['faves'] = FavoriteTrack::where('wishid', '=', $g->id)
                              ->where('type', '=', 2)
                              ->count();

        $g['tracked'] = FavoriteTrack::where('wishid', $g->id)
                                            ->where('userid', $userId)
                                            ->where('type', 1)
                                            ->first();

        $g['tracks'] = FavoriteTrack::where('wishid', '=', $g->id)
                              ->where('type', '=', 1)
                              ->count();
      }
    }
    return view('profile.profile-granted', compact('user', 'granted'));
  }

  public function given()
  {
    $user = Auth::user();
    $userId = $user->id;

    $given = Wish::with('user')
              ->with('wishlist')
              ->where('granted', '=', 1)
              ->where('granterid', '=', $userId)
              ->where('status', '=', 1)
              ->orderBy('created_at', 'desc')
              ->get();


    if (!empty($given)) {
      foreach ($given as $g) {
        $g['favorited'] = '';
        $g['faves'] = '';
        $g['tracked'] = '';
        $g['tracks'] = '';

        $g['favorited'] = FavoriteTrack::where('wishid', $g->id)
                                            ->where('userid', $userId)
                                            ->where('type', 2)
                                            ->first();

        $g['faves'] = FavoriteTrack::where('wishid', '=', $g->id)
                              ->where('type', '=', 2)
                              ->count();

        $g['tracked'] = FavoriteTrack::where('wishid', $g->id)
                                            ->where('userid', $userId)
                                            ->where('type', 1)
                                            ->first();

        $g['tracks'] = FavoriteTrack::where('wishid', '=', $g->id)
                              ->where('type', '=', 1)
                              ->count();
      }

    }
    // dd($given);
    return view('profile.profile-given', compact('user', 'given'));
  }

  public function tynotes()
  {
    $user = Auth::user();
    $userId = $user['id'];

    $usersWithTYNotes = User::with('tynotesOf')->get();
    $tynotes = User::find($userId)->tynotesOf->reverse();

    return view('profile.profile-tynotes', compact('user', 'tynotes'));
  }

  public function deleteTYNoteProfile($id)
  {
    $user = Auth::user();
    $userId = $user->id;
    $tynote = Notes::where('id', $id)->firstorFail();

    $tynote->status = 0;
    $tynote->save();

    if(count($tynote) > 1)
     return redirect('profile/tynotes');
    else
     return redirect('profile/tynotes')->with('errormsg', 'No Thank You Notes.');
  }

}

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

class OtherUserController extends Controller
{
  public function privateUser($id)
  {
    $user = Auth::user();
    $userId = $user['id'];

    if($userId != $id){
      $otherUser = User::where('id', '=', $id)->firstorFail();

      $requests = Friend::with('friendRequest')
                          ->where('userid', '=', $id)
                          ->where('friend_userid', '=', $userId)
                          ->where('status', '=', 0)
                          ->get();

      $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
      $friends = User::find($otherUser->id)->friends;

      $friendRequest = Friend::where('userid', '=', $userId)
                            ->where('friend_userid', '=', $id)
                            ->where('status', '=', 0)
                            ->first();

      if(!empty($friendRequest)){
        $status = 0;
      }
      else {
        $status = 3;
      }

      if(!empty($friends)){
        foreach ($friends as $f) {
          if ($f->id == $userId) {
            $status = $f->pivot->status;
          }
        }
      }
      else{
        $status= 0;
      }
    }

    return view('otheruserprofile.other-private', compact('otherUser', 'requests', 'status'));
  }

  public function profile($id)
  {
    $user = Auth::user();
    $userId = $user['id'];

    if($userId != $id){
      $otherUser = User::where('id', '=', $id)->firstorFail();

      $requests = Friend::with('friendRequest')
                          ->where('userid', '=', $id)
                          ->where('friend_userid', '=', $userId)
                          ->where('status', '=', 0)
                          ->get();

      $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
      $friends = User::find($otherUser->id)->friends;

      $friendRequest = Friend::where('userid', '=', $userId)
                            ->where('friend_userid', '=', $id)
                            ->where('status', '=', 0)
                            ->first();

      if(!empty($friendRequest)){
        $status = 0;
      }
      else {
        $status = 3;
      }

      if(!empty($friends)){
        foreach ($friends as $f) {
          if ($f->id == $userId) {
            $status = $f->pivot->status;
          }
        }
      }
      else{
        $status= 0;
      }
      // dd($requests);
      $wishlistsList = Wishlist::with('user')
                          ->where('createdby_id', '=', $id)
                          ->where('status', '=', 1)
                          ->orderBy('created_at', 'desc')
                          ->lists('title', 'id');

      $wishes = Wish::with('wishlist')
                    ->where('createdby_id', '=', $id)
                    ->where('status', '=', 1)
                    ->where('granted', '!=', 1)
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();

      if (!empty($wishes)) {
        foreach ($wishes as $w) {
          $w['favorited'] = '';
          $w['faves'] = '';
          $w['tracked'] = '';
          $w['tracks'] = '';

          $w['favorited'] = FavoriteTrack::where('wishid', $w->id)
                                              ->where('userid', $id)
                                              ->where('type', 2)
                                              ->first();

          $w['faves'] = FavoriteTrack::where('wishid', '=', $w->id)
                                ->where('type', '=', 2)
                                ->count();

          $w['tracked'] = FavoriteTrack::where('wishid', $w->id)
                                              ->where('userid', $id)
                                              ->where('type', 1)
                                              ->first();

          $w['tracks'] = FavoriteTrack::where('wishid', '=', $w->id)
                                ->where('type', '=', 1)
                                ->count();
        }
      }
    }



    if($userId != $id){
      if(($otherUser->privacy == 1) && $status != 1){
        return redirect()->action('OtherUserController@privateUser', [$id]);
      }
      else{
        return view('otheruserprofile.other-home', compact('otherUser', 'wishes', 'wishlistsList', 'requests', 'status'));
      }

    }
    else
      return view('profile.profile-wishlists', compact('user', 'wishes', 'wishlistsList', 'requests'));

  }

  public function wishlists($id)
  {
    $user = Auth::user();
    $userId = $user['id'];

    if($userId != $id){
      $otherUser = User::where('id', '=', $id)->firstorFail();

      $requests = Friend::with('friendRequest')
                          ->where('userid', '=', $id)
                          ->where('friend_userid', '=', $userId)
                          ->where('status', '=', 0)
                          ->get();

      $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
      $friends = User::find($otherUser->id)->friends;

      $friendRequest = Friend::where('userid', '=', $userId)
                            ->where('friend_userid', '=', $id)
                            ->where('status', '=', 0)
                            ->first();

      if(!empty($friendRequest)){
        $status = 0;
      }
      else {
        $status = 3;
      }

      if(!empty($friends)){
        foreach ($friends as $f) {
          if ($f->id == $userId) {
            $status = $f->pivot->status;
          }
        }
      }
      else{
        $status= 0;
      }

      $wishlistsList = Wishlist::with('user')
                          ->where('createdby_id', '=', $id)
                          ->where('status', '=', 1)
                          ->orderBy('created_at', 'desc')
                          ->lists('title', 'id');

      $wishes = Wish::with('wishlist')
                    ->where('createdby_id', '=', $id)
                    ->where('status', '=', 1)
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();

      if (!empty($wishes)) {
        foreach ($wishes as $w) {
          $w['favorited'] = '';
          $w['faves'] = '';
          $w['tracked'] = '';
          $w['tracks'] = '';

          $w['favorited'] = FavoriteTrack::where('wishid', $w->id)
                                              ->where('userid', $id)
                                              ->where('type', 2)
                                              ->first();

          $w['faves'] = FavoriteTrack::where('wishid', '=', $w->id)
                                ->where('type', '=', 2)
                                ->count();

          $w['tracked'] = FavoriteTrack::where('wishid', $w->id)
                                              ->where('userid', $id)
                                              ->where('type', 1)
                                              ->first();

          $w['tracks'] = FavoriteTrack::where('wishid', '=', $w->id)
                                ->where('type', '=', 1)
                                ->count();
        }
      }
    }
    return view('otheruserprofile.other-wishlists', compact('otherUser', 'wishes', 'wishlistsList', 'requests', 'status'));
  }

  public function granted($id)
  {
    $user = Auth::user();
    $userId = $user['id'];

    if($userId != $id){
      $otherUser = User::where('id', '=', $id)->firstorFail();

      $requests = Friend::with('friendRequest')
                          ->where('userid', '=', $id)
                          ->where('friend_userid', '=', $userId)
                          ->where('status', '=', 0)
                          ->get();

      $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
      $friends = User::find($otherUser->id)->friends;

      $friendRequest = Friend::where('userid', '=', $userId)
                            ->where('friend_userid', '=', $id)
                            ->where('status', '=', 0)
                            ->first();

      if(!empty($friendRequest)){
        $status = 0;
      }
      else {
        $status = 3;
      }

      if(!empty($friends)){
        foreach ($friends as $f) {
          if ($f->id == $userId) {
            $status = $f->pivot->status;
          }
        }
      }
      else{
        $status= 0;
      }

      $granted = Wish::with('wishlist')
                ->where('createdby_id', '=', $id)
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
                                              ->where('userid', $id)
                                              ->where('type', 2)
                                              ->first();

          $g['faves'] = FavoriteTrack::where('wishid', '=', $g->id)
                                ->where('type', '=', 2)
                                ->count();

          $g['tracked'] = FavoriteTrack::where('wishid', $g->id)
                                              ->where('userid', $id)
                                              ->where('type', 1)
                                              ->first();

          $g['tracks'] = FavoriteTrack::where('wishid', '=', $g->id)
                                ->where('type', '=', 1)
                                ->count();
        }
      }
    }
    return view('otheruserprofile.other-granted', compact('otherUser', 'granted', 'requests', 'status'));
  }

  public function wishes($id, $wishlistid)
  {
    $user = Auth::user();
    $userId = $user['id'];
    // dd($id);
    if($userId != $id){
      $otherUser = User::where('id', '=', $id)->firstorFail();

      $requests = Friend::with('friendRequest')
                          ->where('userid', '=', $id)
                          ->where('friend_userid', '=', $userId)
                          ->where('status', '=', 0)
                          ->get();

      $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
      $friends = User::find($otherUser->id)->friends;

      $friendRequest = Friend::where('userid', '=', $userId)
                            ->where('friend_userid', '=', $id)
                            ->where('status', '=', 0)
                            ->first();

      if(!empty($friendRequest)){
        $status = 0;
      }
      else {
        $status = 3;
      }

      if(!empty($friends)){
        foreach ($friends as $f) {
          if ($f->id == $userId) {
            $status = $f->pivot->status;
          }
        }
      }
      else{
        $status= 0;
      }

      $wishlists = Wishlist::with('wishes')
                            ->where('id', '=', $wishlistid)
                            ->where('createdby_id', '!=', $userId)
                            ->where('status', '=', 1)
                            ->where('privacy', '=', 0)
                            ->orderBy('created_at', 'desc')
                            ->get();
    }
    return view('otheruserprofile.other-wishes', compact('otherUser', 'wishlists', 'requests', 'status'));
  }

  public function given($id)
  {
    $user = Auth::user();
    $userId = $user['id'];


    if($userId != $id){
      $otherUser = User::where('id', '=', $id)->firstorFail();
      $requests = Friend::with('friendRequest')
                          ->where('userid', '=', $id)
                          ->where('friend_userid', '=', $userId)
                          ->where('status', '=', 0)
                          ->get();

      $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
      $friends = User::find($otherUser->id)->friends;

      $friendRequest = Friend::where('userid', '=', $userId)
                            ->where('friend_userid', '=', $id)
                            ->where('status', '=', 0)
                            ->first();

      if(!empty($friendRequest)){
        $status = 0;
      }
      else {
        $status = 3;
      }

      if(!empty($friends)){
        foreach ($friends as $f) {
          if ($f->id == $userId) {
            $status = $f->pivot->status;
          }
        }
      }
      else{
        $status= 0;
      }

      $given = Wish::with('user')
                ->with('wishlist')
                ->where('granted', '=', 1)
                ->where('granterid', '=', $id)
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
    }
    return view('otheruserprofile.other-given', compact('otherUser', 'given', 'requests', 'status'));
  }

  public function wishWishlists($id)
  {
    $user = Auth::user();
    $userId = $user['id'];

    if($userId != $id){
      $otherUser = User::where('id', '=', $id)->firstorFail();
      // dd($id);
      $requests = Friend::with('friendRequest')
                          ->where('userid', '=', $id)
                          ->where('friend_userid', '=', $userId)
                          ->where('status', '=', 0)
                          ->get();

      $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
      $friends = User::find($otherUser->id)->friends;

      $friendRequest = Friend::where('userid', '=', $userId)
                            ->where('friend_userid', '=', $id)
                            ->where('status', '=', 0)
                            ->first();

      if(!empty($friendRequest)){
        $status = 0;
      }
      else {
        $status = 3;
      }

      if(!empty($friends)){
        foreach ($friends as $f) {
          if ($f->id == $userId) {
            $status = $f->pivot->status;
          }
        }
      }
      else{
        $status= 0;
      }

      $wishlists = Wishlist::with('wishes')
                            ->where('createdby_id', '=', $id)
                            ->where('status', '=', 1)
                            ->where('privacy', '=', 0)
                            ->orderBy('created_at', 'desc')
                            ->get();
    }

    return view('otheruserprofile.other-wishWishlists', compact('otherUser', 'wishlists', 'requests', 'status'));
  }

  public function tracked($id)
  {
    $user = Auth::user();
    $userId = $user['id'];

    if($userId != $id){
      $otherUser = User::where('id', '=', $id)->firstorFail();

      $requests = Friend::with('friendRequest')
                          ->where('userid', '=', $id)
                          ->where('friend_userid', '=', $userId)
                          ->where('status', '=', 0)
                          ->get();

      $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
      $friends = User::find($otherUser->id)->friends;

      $friendRequest = Friend::where('userid', '=', $userId)
                            ->where('friend_userid', '=', $id)
                            ->where('status', '=', 0)
                            ->first();

      if(!empty($friendRequest)){
        $status = 0;
      }
      else {
        $status = 3;
      }

      if(!empty($friends)){
        foreach ($friends as $f) {
          if ($f->id == $userId) {
            $status = $f->pivot->status;
          }
        }
      }
      else{
        $status= 0;
      }

      $tracked = FavoriteTrack::with('wish')
                      ->where('type', '=', 1)
                      ->where('userid', '=', $id)
                      ->orderBy('created_at', 'desc')
                      ->get();

      if (!empty($tracked)) {
        foreach ($tracked as $tr) {
          $tr['favorited'] = '';
          $tr['faves'] = '';
          $tr['tracked'] = '';
          $tr['tracks'] = '';

          $tr['favorited'] = FavoriteTrack::where('wishid', $tr->id)
                                              ->where('userid', $id)
                                              ->where('type', 2)
                                              ->first();

          $tr['faves'] = FavoriteTrack::where('wishid', '=', $tr->id)
                                ->where('type', '=', 2)
                                ->count();

          $tr['tracked'] = FavoriteTrack::where('wishid', $tr->id)
                                              ->where('userid', $id)
                                              ->where('type', 1)
                                              ->first();

          $tr['tracks'] = FavoriteTrack::where('wishid', '=', $tr->id)
                                ->where('type', '=', 1)
                                ->count();
        }
      }
    }

    return view('otheruserprofile.other-tracked', compact('otherUser', 'tracked', 'requests', 'status'));
  }

  public function friends($id)
  {
    $user = Auth::user();
    $userId = $user->id;

    if($userId != $id){
      $otherUser = User::where('id', '=', $id)->firstorFail();

      $requests = Friend::with('friendRequest')
                          ->where('userid', '=', $id)
                          ->where('friend_userid', '=', $userId)
                          ->where('status', '=', 0)
                          ->get();

      $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
      $friends = User::find($otherUser->id)->friends;

      $friendRequest = Friend::where('userid', '=', $userId)
                            ->where('friend_userid', '=', $id)
                            ->where('status', '=', 0)
                            ->first();

      if(!empty($friendRequest)){
        $status = 0;
      }
      else {
        $status = 3;
      }

      if(!empty($friends)){
        foreach ($friends as $f) {
          if ($f->id == $userId) {
            $status = $f->pivot->status;
          }
        }
      }
      else{
        $status= 0;
      }

      $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
      $friends = User::find($id)->friends;
    }

    return view('otheruserprofile.other-friends', compact('otherUser', 'friends', 'requests', 'status'));
  }

  public function tynotes($id)
  {
    $user = Auth::user();
    $userId = $user['id'];

    if($userId != $id){
      $otherUser = User::where('id', '=', $id)->firstorFail();

      $requests = Friend::with('friendRequest')
                          ->where('userid', '=', $id)
                          ->where('friend_userid', '=', $userId)
                          ->where('status', '=', 0)
                          ->get();

      $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
      $friends = User::find($otherUser->id)->friends;

      $friendRequest = Friend::where('userid', '=', $userId)
                            ->where('friend_userid', '=', $id)
                            ->where('status', '=', 0)
                            ->first();

      if(!empty($friendRequest)){
        $status = 0;
      }
      else {
        $status = 3;
      }

      if(!empty($friends)){
        foreach ($friends as $f) {
          if ($f->id == $userId) {
            $status = $f->pivot->status;
          }
        }
      }
      else{
        $status= 0;
      }

      $usersWithTYNotes = User::with('tynotesOf')->get();
      $tynotes = User::find($id)->tynotesOf->reverse();
    }

    return view('otheruserprofile.other-tynotes', compact('otherUser', 'tynotes', 'requests', 'status'));
  }

}

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

class OtherWishlistController extends Controller
{
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
}

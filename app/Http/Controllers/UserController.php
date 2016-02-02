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

class UserController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');

  }

  public function dashboard()
  {
    return view('userlayouts-master.user-master');
  }

  public function postSignup()
  {
    $user = Auth::user();
    // return redirect()->action('UserController@notifications');
    return view('userlayouts.postSignup', compact('user'));
  }

  public function home()
  {
    $user = Auth::user();

    // if (!empty(Auth::user()->password) and !empty(Auth::user()->username)){
    if (!empty(Auth::user()->password) and Auth::user()->username == null){
      $wishlists = Wishlist::with('user')
                          ->where('createdby_id', '=', $user->id)
                          ->where('status', '=', 1)
                          ->orderBy('created_at', 'desc')
                          ->lists('title', 'id');

      $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
      $friends = User::find($user->id)->friends;

      $friendsId[] = $user->id;


      foreach($friends as $friend){
        if ($user->id == $friend->pivot->userid) {
          $friendsId[] = $friend->pivot->friend_userid;
        } else {

          $friendsId[] = $friend->pivot->userid;
        }

      }
      $fstream = array();
      $wishes = new Wish();
      $stream = $wishes->stream($friendsId);

      if(!empty($stream)){
        foreach ($stream as $s) {
          $s = (array)$s;
          $tags = Tag::with('user')->where('wishid', '=', $s['wishid'])->get();

          if(count($tags)>0){
            foreach ($tags as $t) {
                $s['tagged'][] = $t->user;
            }
          }
          // $fstream[] = $s;

          $fave = FavoriteTrack::where('wishid', '=', $s['wishid'])
                                  ->where('userid', '=', $user->id)
                                  ->where('type', '=', 2)
                                  ->first();
          $faves = FavoriteTrack::where('wishid', '=', $s['wishid'])
                                  ->where('type', '=', 2)
                                  ->count();
          $s['favorited'] = '';
          $s['faves'] = $faves;
          if(!empty($fave)){
              $s['favorited'] = $fave;


          }

          $track = FavoriteTrack::where('wishid', '=', $s['wishid'])
                                  ->where('userid', '=', $user->id)
                                  ->where('type', '=', 1)
                                  ->first();
          $tracks = FavoriteTrack::where('wishid', '=', $s['wishid'])
                                  ->where('type', '=', 1)
                                  ->count();
          $s['tracked'] = '';
          $s['tracks'] = $tracks;
          if(!empty($track)){
              $s['tracked'] = $track;


          }

          $fstream[] = $s;
        }
      }
      // dd($fstream);
        return view('userlayouts.home', compact('fstream', 'friends', 'wishlists', 'user'));
    }
    else {
      return redirect('user/setup');
    }
  }

  public function search(Request $request)
  {
    $user = Auth::user();
    $search = $request->search;

    $results = User::where('type', '=', 1)
                    ->where('status', '=', 1)
                    ->where(function ($query) use ($search){
                        $query->where('firstname', 'like', '%'.$search.'%')
                              ->orWhere('lastname', 'like', '%'.$search.'%')
                              ->orWhere('username', 'like', '%'.$search.'%');
                    })
                    // ->where('firstname', 'like', '%'.$search.'%')
                    // ->orWhere('lastname', 'like', '%'.$search.'%')
                    // ->orWhere('username', 'like', '%'.$search.'%')
                    ->paginate();
                    // ->get();
    // dd($results);
    // if(!empty($results))
      return view('userlayouts.searchFriend', compact('results', 'user'));
    // else{
      // return view('userlayouts.searchFriend')->with('errormsg', 'Not found');
    // }
  }

  public function setPassword()
  {
      $user = Auth::user();
      return view('userlayouts.setPassword', compact('user'));
  }

  public function notifications()
  {
    $user = Auth::user();

    // $requests = Friend::with('friendRequest')->where('status', '=', '0')->get();

    // $grant = Wish::where('createdby_id', '=', $user['id'])->where('status', '=', 1)->where('granted', '=', 2)->get();
    $grant = Wish::where('createdby_id', '=', $user['id'])
                  ->where('status', '=', 1)
                  ->where('granted', '=', 0)
                  ->where('granterid', '!=', 0)
                  ->get();

    if(!empty($grant))
    {
      for($i=0; $i < count($grant); $i++) {
        $granter = User::where('id', '=', $grant[$i]['granterid'])->where('status', '=', 1)->first();
        if(!empty($granter))
          $grant[$i]['granter'] = $granter;
      }
    }

    $requests = Friend::where('friend_userid', '=', $user['id'])->where('status', '=', '0')->get();
    // print($requests);
    // die();
    $tags = Tag::where('userid', '=', $user['id'])->orderby('created_at', 'desc')->get();

    for ($i=0; $i < count($tags); $i++) {
      $wish = Wish::where('id', '=', $tags[$i]['wishid'])->where('status', '=', 1)->first();
      // $tagger = User::where('id', '=', $tags[$i]['userid'])->where('status', '=', 1)->first();
      if(!empty($wish)){
        $tags[$i]['notificationtype'] = 'tagged';
        $tagger = User::where('id', '=', $wish['createdby_id'])->where('status', '=', 1)->first();
        $tags[$i]['wish'] = $wish;
        if(!empty($tagger)){
          $tags[$i]['tagger'] = $tagger;
        }
      }
    }

    $trackfave = FavoriteTrack::with('wish', 'user')->whereHas('wish', function($query) use($user){
      $query->where('createdby_id', '=', $user['id']);
    })->get();
    // dd($trackfave);
    foreach ($trackfave as $tf) {
      if ($tf->type == 1) {
        $tf['notificationtype'] = 'tracked';
      }
      else {
        $tf['notificationtype'] = 'favorited';
      }
    }
    // dd($trackfave);
    $n = $tags->merge($trackfave);
    $notifs = $n->sortByDesc('created_at');
    $notifs->values()->all();
    // dd($notifs);
    // print_r($ttf); die();
    // json_encode($ttf);print($ttf); die();
   return view('userlayouts.notifications', compact('requests', 'tags', 'grant', 'user', 'notifs'));
  }

  public function notes()
  {
    $user = Auth::user();
    return view('userlayouts.notes', compact('user'));
  }
  public function wish($id)
  {
    $user = Auth::user();
    $userId = $user->id;
    $wish = Wish::with('granter', 'wishlist', 'user')->where('id', '=', $id)->first();

    $wish['favorited'] = '';

    $wish['faves'] = '';

    $wish['tracked'] = '';

    $wish['tracks'] = '';
    if (!empty($wish)) {
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
    // dd($wish);
    $grant = Wish::where('id', '=', $id)->get();
    $tags = Tag::with('user')->where('wishid', '=', $id)->get();
    $wishlists = Wishlist::with('wishes')->where('createdby_id', '=', $userId)->where('status', '=', 1)
                      ->orderBy('created_at', 'desc')->get();
    $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
    $friends = User::find($userId)->friends;
    // print($wish); die();
    return view('userlayouts.wish', compact('wish', 'tags', 'wishlists', 'friends', 'grant', 'user'));
  }

  public function deactivate()
  {
    return view('userlayouts.deactivate');
  }
  public function help()
  {
    $user = Auth::user();
    return view('userlayouts.help', compact('user'));
  }
  public function changepass()
  {
    $user = Auth::user();

    // if (!empty(Auth::user()->password) and !empty(Auth::user()->username)){
    if (!empty(Auth::user()->password) and Auth::user()->username == null){
      return view('userlayouts.changepass', compact('user'));
      // return view('userlayouts.home');
    }
    else {
      return redirect('user/setup');
    }
    // return view('userlayouts.changepass');
  }
  public function wishlistAction()
  {
    $user = Auth::user();
    return view('userlayouts.wishlistAction', compact('wishlists', 'user'));
  }

  public function wishAction()
  {
    $user = Auth::user();
    $userId = $user->id;
    $wishlists = Wishlist::with('user')
                        ->where('createdby_id', '=', $userId)
                        ->where('status', '=', 1)
                        ->orderBy('created_at', 'desc')
                        ->lists('title', 'id');

    $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
    $friends = User::find($userId)->friends;

    return view('userlayouts.wishAction', compact('friends', 'wishlists', 'user'));
  }

  public function addWish(WishRequest $request)
  {

    $user = Auth::user();

    $newImage = '';
    $hostURL = 'images.wishare.net';
    // $hostURL = '192.168.1.28';
    $newImage = Input::file('wishimageurl');

    if($newImage == null)
    {
      if($request->flag == null)
        $flag = 0;
      else
        $flag = 1;

      $wish = new Wish(array(
        'wishlistid' => $request->wishlist,
        'title' => $request->title,
        'due_date' => $request->due_date,
        'createdby_id' => $user->id,
        'details' => $request->details,
        'alternatives' => $request->alternatives,
        'flagged' => $flag,
        'status' => 1,
      ));
    }
    else
    {
      $filename  = $user->id . time() . '.' . $newImage->getClientOriginalExtension();
      $path = ('/var/www/images.wishare.net/public_html/wishareimages/wishimages/' . $filename);
      // $path = ('C:/xampp/htdocs/wishareimages/wishimages/' . $filename);
      Image::make($newImage->getRealPath())->save($path);

      if($request->flag == null)
        $flag = 0;
      else
        $flag = 1;

      $wish = new Wish(array(
        'wishlistid' => $request->wishlist,
        'title' => $request->title,
        'due_date' => $request->due_date,
        'createdby_id' => $user->id,
        'details' => $request->details,
        'alternatives' => $request->alternatives,
        'flagged' => $flag,
        'wishimageurl' => 'http://' . $hostURL . '/wishimages/'.$filename,
        // 'wishimageurl' => 'http://' . $hostURL . '/wishareimages/wishimages/'.$filename,
        'status' => 1,
      ));

    }


    $wish->save();

    if (!empty($request->tags)) {
      foreach ($request->tags as $t) {
        $tag = new Tag(array(
          'wishid' => $wish->id,
          'userid' => $t,
        ));
        $tag->save();
      }
    }

    return redirect('user/action/wish')->with('wishStatus', 'New wish added!');
  }

  public function addWishModal(WishRequest $request, $id)
  {

    $user = Auth::user();

    $newImage = '';
    // $hostURL = '192.168.1.28';
    $hostURL = 'images.wishare.net';
    $newImage = Input::file('wishimageurl');

    if($newImage == null)
    {
      if($request->flag == null)
        $flag = 0;
      else
        $flag = 1;

      $wish = new Wish(array(
        'wishlistid' => $id,
        'title' => $request->title,
        'due_date' => $request->due_date,
        'createdby_id' => $user->id,
        'details' => $request->details,
        'alternatives' => $request->alternatives,
        'flagged' => $flag,
        'status' => 1,
      ));
    }
    else
    {
      $filename  = $user->id . time() . '.' . $newImage->getClientOriginalExtension();
      $path = ('/var/www/images.wishare.net/public_html/wishareimages/wishimages/' . $filename);
      // $path = ('C:/xampp/htdocs/wishareimages/wishimages/' . $filename);
      Image::make($newImage->getRealPath())->save($path);

      if($request->flag == null)
        $flag = 0;
      else
        $flag = 1;

      $wish = new Wish(array(
        'wishlistid' => $id,
        'title' => $request->title,
        'due_date' => $request->due_date,
        'createdby_id' => $user->id,
        'details' => $request->details,
        'alternatives' => $request->alternatives,
        'flagged' => $flag,
        'wishimageurl' => 'http://' . $hostURL . '/wishimages/'.$filename,
        // 'wishimageurl' => 'http://' . $hostURL . '/wishareimages/wishimages/'.$filename,
        'status' => 1,
      ));
    }


    $wish->save();

    if (!empty($request->tags)) {
      foreach ($request->tags as $t) {
        $tag = new Tag(array(
          'wishid' => $wish->id,
          'userid' => $t,
        ));
        $tag->save();
      }
    }

    return redirect('/profile')->with('wishStatus', 'New wish added!');
  }

  public function editTags($id)
  {
    $wishid = $id;
    $user = Auth::user();
    $userId = $user->id;

    $tags = Tag::where('wishid', '=', $id)->get();

    $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
    $friends = User::find($userId)->friends;


    for ($i=0; $i < count($friends) ; $i++) {
      foreach ($tags as $t) {
        if($friends[$i]['id'] == $t->userid){
          $friends[$i]['tagstatus'] = 1;
          break;
        }
        else{
          $friends[$i]['tagstatus'] = 0;
        }
      }
    }
    return view('userlayouts.tagEdit', compact('friends', 'tags', 'wishid', 'user'));
  }

  public function updateTags(TagRequest $request, $id)
  {
    $updatedTags = $request->tags;

    if(!empty($updatedTags)){
      $tagged = Tag::where('wishid', '=', $id)->get();
      // dd($tagged);
      if(count($tagged)>0){

        $tobeRemovedTags = Tag::where('wishid', '=', $id)->whereNotIn('userid', $updatedTags)->get();
        if(count($tobeRemovedTags)>0){
          foreach ($tobeRemovedTags as $rt) {
            $rt->delete();
          }
        }

        for ($i=0; $i < count($updatedTags); $i++) {
          foreach ($tagged as $tag) {
            $t = Tag::where('userid', '=', $updatedTags[$i])->where('wishid', '=', $id)->first();
            if(!empty($t)){
              print('ALREADY TAGGED ///');
              break;
            }
            else{
              print('add the thing');
              $newtag = new Tag(array(
                'wishid' => $id,
                'userid' => $updatedTags[$i],
              ));
              $newtag->save();
              break;
            }
          }
        }
      }
      else{
        print('ADD ALL THE THINGS');
        foreach ($updatedTags as $uTag) {
          $newtag = new Tag(array(
            'wishid' => $id,
            'userid' => $uTag,
          ));
          $newtag->save();
        }
      }
    }
    else {
      // print('else');
      $tagged = Tag::where('wishid', '=', $id)->get();
      if(count($tagged)>0){
        // print('else2');
        $tobeRemovedTags = Tag::where('wishid', '=', $id)->get();
        // dd($tobeRemovedTags);
        if(count($tobeRemovedTags)>0){
          // print('else3');
          foreach ($tobeRemovedTags as $rt) {
            $rt->delete();
            print('deleted');
          }
        }
      }
      // else
      //   print('NOTHING TO TAG');
    }
    // die();
    return redirect('user/home')->with('tagStatus', 'Tags has been updated!');
  }

  public function updateWish(WishRequest $request, $id)
  {
    $user = Auth::user();
    $newImage = '';
    $hostURL = 'images.wishare.net';
    // $hostURL = '192.168.1.28';
    $newImage = Input::file('wishimageurl');

    if($newImage == null) {
      if($request->flag == null)
        $flag = 0;
      else
        $flag = 1;
      $wish = Wish::where('id', '=', $id)->where('status', '=', 1)->first();

      if (!empty($wish)) {
        $wish->wishlistid = $request->wishlist;
        $wish->title = $request->title;
        $wish->details = $request->details;
        $wish->alternatives = $request->alternatives;
        $wish->due_date = $request->due_date;
        $wish->flagged = $flag;
        $wish->wishimageurl = $wish->wishimageurl;
        $wish->save();
     }
    }
    else {
      $filename  = $user->id . time() . '.' . $newImage->getClientOriginalExtension();
      $path = ('/var/www/images.wishare.net/public_html/wishareimages/wishimages/' . $filename);
      // $path = ('C:/xampp/htdocs/wishareimages/wishimages/' . $filename);
      Image::make($newImage->getRealPath())->save($path);


      if($request->flag == null)
        $flag = 0;
      else
        $flag = 1;

      $wish = Wish::where('id', '=', $id)->where('status', '=', 1)->first();

      if (!empty($wish)) {
        $wish->wishlistid = $request->wishlist;
        $wish->title = $request->title;
        $wish->details = $request->details;
        $wish->alternatives = $request->alternatives;
        $wish->due_date = $request->due_date;
        $wish->flagged = $flag;
        $wish->wishimageurl = 'http://' . $hostURL . '/wishimages/'.$filename;
        // $wish->wishimageurl = 'http://' . $hostURL . '/wishareimages/wishimages/'.$filename;
        $wish->save();
      }
    }

    return redirect('user/home')->with('wishStatus', 'Wish udpated successfully!');
  }

  public function updateWishDetails($id)
  {
    $user = Auth::user();
    $userId = $user['id'];

    $wishlistsList = Wishlist::with('wishes')
                        ->where('createdby_id', '=', $userId)
                        ->where('status', '=', 1)
                        ->lists('title', 'id');

    $wish = Wish::where('id', '=', $id)->first();

    return view('userlayouts.editWish', compact('user', 'wish', 'wishlistsList'));
  }

  public function deleteWish($id)
  {
    $user = Auth::user();
    $userId = $user['id'];

    $wish = Wish::where('id', '=', $id)->first();

    if(!empty($wish)){
      $wish->status = 0;
      $wish->save();

      $tags = Tag::where('wishid', '=', $wish->id)->get();

      if (!empty($tags)) {
        foreach ($tags as $tag) {
          $tag->delete();
        }
      }
    }

    return redirect()->action('UserProfilesController@profile');

  }

  public function notesAction()
  {
    $user = Auth::user();
    return view('userlayouts.notesAction', compact('user'));
  }

  public function tynotesAction()
  {
    $user = Auth::user();
    return view('userlayouts.tynotesAction', compact('user'));
  }
  /* Other user */
  public function otheruser($id)
  {
    $user = Auth::user();
    $userId = $user['id'];

    if($userId != $id){
      $otherUser = User::where('id', '=', $id)->firstorFail();


      $requests = Friend::with('friendRequest')
                          ->where('userid', '=', $otherUser->id)
                          ->where('friend_userid', '=', $userId)
                          ->where('status', '=', 0)
                          ->get();
      // print($requests);
      // die();
      $wishlists = Wishlist::with('wishes')->where('createdby_id', '=', $id)->where('status', '=', '1')
                        ->orderBy('created_at', 'desc')->get();

      $wishlistOtherUser = Wishlist::with('wishes')->where('createdby_id', '=', $userId)->where('status', '=', 1)
                          ->orderBy('created_at', 'desc')->lists('title', 'id');

      $tags = Wish::with('tags')->where('createdby_id', '=', $userId)->where('status', '=', 1)->get();

      $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
      $friends = User::find($otherUser->id)->friends;

      $myFriends = User::with('friendsOfMine')->get();
      $friendsOtherUser = User::find($userId)->friends;

      $usersWithTYNotes = User::with('myTYNotes')->get();
      $tynotes = User::find($userId)->myTYNotes->reverse();

      // print($friend);
      // die();
      // if(count($friends)==0){
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



      if(($otherUser->privacy == 1) && $status != 1){

          return view('otheruser.otheruserprivate', compact('otherUser', 'friends', 'status', 'requests', 'user'));
      }
      else {
          return view('otheruser.otheruserprofile', compact('otherUser', 'friends', 'status', 'requests', 'wishlists', 'tags', 'tynotes', 'wishlistOtherUser', 'friendsOtherUser', 'user'));
      }
    }
    else {
      return redirect()->action('ProfileController@wishlists');
    }
  }

  // public function store(UserRequest $request)
  // {
  //
  //   $user = new User(array(
  //     'imageurl' => 'http://192.168.1.7/wishareimages/userimages/default.jpg',
  //     'lastname' => trim($request->lastname),
  //     'firstname' => trim($request->firstname),
  //     'username' => trim($request->username),
  //     'email' => trim($request->email),
  //     'privacy' => 0,
  //     'type' => 1,
  //     'status' => 1,
  //     'defaultwishlist' => 0,
  //     'password' => trim(bcrypt($request->get('password'))),
  //   ));
  //
  //   $user->save();
  //
  //   //========= get default wishlists and store to users wishlists
  //   if(!Auth::check()){
  //     if (Auth::attempt(['email' => $request['email'], 'password' => $request['password'], 'status' => 1]))
  //     {
  //       $user = User::where('email', $request['email'])->firstorFail();
  //       $type = $user->type;
  //       $status = $user->status;
  //       // var_dump($user);
  //
  //       $defaultwishlists = DefaultWishlist::where('status', '=', 1)
  //                                           ->orderBy('created_at', 'desc')
  //                                           ->get();
  //
  //       // var_dump($defaultwishlists);
  //
  //       foreach ($defaultwishlists as $dw) {
  //
  //         $wishlist = new Wishlist(array(
  //           'title' => $dw->title,
  //           'createdby_id' => $user->id,
  //           'privacy' => 0,
  //           'status' => 1,
  //         ));
  //
  //         $wishlist->save();
  //       }
  //
  //       $user->defaultwishlist = 1;
  //
  //       $user->save();
  //
  //
  //       return view('userlayouts.home');
  //
  //     }
  //   }
  //   else {
  //     print("Not logged in");
  //   }
  //
  //   // return redirect('/user/home');
  // }

  public function getUserDetails()
  {
    //profile details
    $user = Auth::user();
    $userId = $user['id'];
    //var_dump($user);
    //

    //wishlist
    $wishlists = '';
    $wishlistsList = Wishlist::with('user')
                        ->where('createdby_id', '=', $userId)
                        ->where('status', '=', 1)
                        ->orderBy('created_at', 'desc')
                        ->lists('title', 'id');

    $wishlists = Wishlist::with('wishes')->where('createdby_id', '=', $userId)->where('status', '=', 1)
                      ->orderBy('created_at', 'desc')->get();

    $wishlistsRewish = Wishlist::with('wishes')->where('createdby_id', '=', $userId)->where('status', '=', 1)
                      ->orderBy('created_at', 'desc')->lists('title', 'id');

    $tags = Wish::with('tags')->where('createdby_id', '=', $userId)->where('status', '=', 1)->get();
    // print($tags); die();
    // print($wishlists); die();
    // dd($wishlists);
    // $friends = Friend::with('userFriends', 'addedFriends')
    //                   ->where('status', '=', 1)
    //                   ->where(function ($query) use ($userId){
    //                       $query->where('userid', '=', $userId)
    //                             ->orWhere('friend_userid', '=', $userId);
    //                   })
    //                   ->get();

    // $friends = Friend::with('userFriends', 'addedFriends')
    //                   ->where('status', '=', 1)
    //                   ->where(function ($query) use ($userId){
    //                       $query->where('userid', '=', $userId)
    //                             ->orWhere('friend_userid', '=', $userId);
    //                   })
    //                   ->get();

      $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
      $friends = User::find($userId)->friends;

      $usersWithTYNotes = User::with('tynotesOf')->get();
      $tynotes = User::find($userId)->tynotesOf->reverse();
      // dd($user);

    //  dd($friends);
    if(count($wishlists) > 0 || !empty($user) || !empty($friends))
      return view('userlayouts.profile', compact('user', 'wishlists', 'friends', 'wishlistsList', 'tags', 'tynotes', 'wishlistsRewish'));
    // /var_dump($wishlists);


  }

  public function editSettings()
  {
    $user = Auth::user();
    $id = $user['id'];
    //$user = User::where('id', $id)->first();
    //var_dump($user);
    return view('userlayouts.settings', compact('user'));
  }

  public function updateUserSettings(Request $request)
  {
    //$user = User::where('id', $id);
    $user = Auth::user();
    $id = $user->id;
    $details = array();
    // $user->firstname = $request->get('firstname');
    // $user->lastname = $request->get('lastname');
    // $user->city = $request->get('city');
    // $user->username = $request->get('username');
    // $user->email = $request->get('email');
    // $user->facebook = $request->get('facebook');
    // $user->birthdate = $request->get('birthdate');

    if($request->get('firstname') != '')
      $details['firstname'] = $request->get('firstname');

    if($request->get('lastname') != '')
      $details['lastname'] = $request->get('lastname');

    // if($request->get('city') != '')
      $details['city'] = $request->get('city');

    if($request->get('username') != '' and $request->get('username') != $user->username){
      // if ($request->get('username') != $user->username) {
        // $details['username'] = $user->username;
      // }
      // else {
        $details['username'] = $request->get('username');
      // }
    }

    if($request->get('email') != '' and $request->get('email') != $user->email){
      // if ($request->get('email') != $user->email) {
        // $details['email'] = $user->email;
      // }
      // else {
        $details['email'] = $request->get('email');
      // }
    }

    if($request->get('facebook') != '')
      $details['facebook'] = $request->get('facebook');

    if($request->get('birthdate') != '')
      $details['birthdate'] = $request->get('birthdate');

    $details['privacy'] = $request->privacy;

    $messages = [
        'imageurl.image' => 'File to be uploaded must be an image file (jpeg, png, bmp, gif, or svg).',

        'firstname.required' => 'First name is required.',
        'firstname.min' => 'First name must be at least 3 characters.',
        'firstname.max' => 'First name may not be greater than 50 characters.',
        'firstname.regex' => 'First name may only contain letters.',

        'lastname.required' => 'Last name is required.',
        'lastname.min' => 'Last name must be at least 2 characters.',
        'lastname.max' => 'Last name may not be greater than 50 characters.',
        'lastname.regex' => 'Last name may only contain letters.',

        'city.min' => 'City must be at least 2 characters.',
        'city.max' => 'City may not be greater than 50 characters.',
        'city.regex' => 'City may only contain letters.',

        'username.required' => 'Username is required.',
        'username.min' => 'Username must be at least 3 characters.',
        'username.max' => 'Username may not be greater than 15 characters.',
        'username.alpha_num' => 'Username may only contain letters and numbers.',
        'username.unique' => 'Username has already been taken.',

        'email.required' => 'Email is required.',
        'email.email' => 'Email must be a valid email address.',
        'email.unique' => 'Email has already been taken.',

        'facebook.min' => 'Facebook Username must be at least 3 characters.',
        'facebook.max' => 'Facebook Username may not be greater than 50 characters.',

        'birthdate.before' => 'Birthdate must not be after today.',
    ];

    $validator = Validator::make($details, [
        'imageurl'  => 'image',
        'firstname' => 'required|min:3|max:50|regex:/^[\pL\s]+$/u',
        'lastname'  => 'required|min:2|max:50|regex:/^[\pL\s]+$/u',
        'city'      => 'min:2|max:50|regex:/^[\pL\s]+$/u',
        'username'  => 'sometimes|required|min:3|max:15|alpha_num|unique:wishare_users',
        'email'     => 'sometimes|required|email|unique:wishare_users',
        'facebook'  => 'min:3|max:50|',
        'birthdate' => 'date|before:tomorrow|date_format:Y-m-d',
      ], $messages);

      if ($validator->fails()) {
          return redirect('user/settings')
                      ->withErrors($validator);
                      // ->withInput();
      }
      else{
        // $user->save();
        $updateUser = User::where('id','=',$user->id)->update($details);

        //return redirect(action('userController@editSettings', $user->id))->with('status', 'Saved.');
        return redirect('user/settings')->with('status', 'Saved!');
      }


    // $user->save();
    //
    // //return redirect(action('userController@editSettings', $user->id))->with('status', 'Saved.');
    // return redirect('user/settings')->with('status', 'Saved!');
  }

  public function updateProfilePic()
  {
    $user = Auth::user();
    $id = $user->id;
    $newImage = '';
    $hostURL = 'images.wishare.net';
    // $hostURL = '192.168.1.28';
    $newImage = Input::file('imageurl');
    if($newImage == null)
    {
      $user->imageurl =  $user->imageurl;
    }
    else
    {
      $filename  = $user->id . time() . '.' . $newImage->getClientOriginalExtension();

      $path = ('/var/www/images.wishare.net/public_html/wishareimages/userimages/' . $filename);
      // $path = ('C:/xampp/htdocs/wishareimages/userimages/' . $filename);
      Image::make($newImage->getRealPath())->fit(150, 150)->save($path);
      $user->imageurl =  'http://' . $hostURL . '/userimages/'.$filename;
      // $user->imageurl =  'http://' . $hostURL . '/wishareimages/userimages/'.$filename;
    }
    $user->save();

    //return redirect(action('userController@editSettings', $user->id))->with('status', 'Saved.');
    return redirect('user/settings#tab-pic')->with('status', 'Saved!');
  }

  public function updateToSetPassword(SetPasswordRequest $request)
  {
    $user = Auth::user();
    $user->username = $request->get('username');
    $user->password = bcrypt($request->get('password'));

    $user->save();

    return redirect('user/home');
  }

  public function changeAccountPassword(AccountPasswordRequest $request)
  {
    $user = Auth::user();
    $password = $request->oldpassword;
    $userpw = $user->password;

    //check if inputted current pw matches from db
    if(Hash::check($password, $userpw))
    {
      $user->password = bcrypt($request->get('password'));
      $user->save();
      return redirect('user/settings/changepassword')->with('passwordStatus', 'Password updated successfully!');
    }
    else
      return redirect('user/settings/changepassword')->with('passwordError', 'Current password incorrect.');
  }

  public function createWishlist(WishlistRequest $request)
  {
    $user = Auth::user();
    $id = $user->id;
    $wishlist = new Wishlist(array(
      'createdby_id' => $id,
      'title' => trim($request->title),
      'privacy' => $request->privacy,
      'status' => 1,
    ));
    $wishlist->save();
    return redirect('user/action/wishlist')->with('wishlistStatus', 'New wishlist added!');
  }

  public function updateWishlist (WishlistRequest $request, $id)
  {
    $user = Auth::user();
    $wishlist = Wishlist::where('id', $id)->first();
    $wishlist->title = $request->get('title');
    $wishlist->privacy = $request->privacy;
    $wishlist->save();
    //return Redirect::back()->with('wishlistSettings', 'Wishlist udpated successfully!');
    return redirect('profile/wishlists')->with('wishlistSettings', 'Wishlist udpated successfully!');
  }

  public function deleteWishlist($id)
  {
    $user = Auth::user();
    $wishlist = Wishlist::where('id', $id)->firstorFail();
    $wishlist->status = 0;
    $wishlist->save();

    return redirect('profile/wishlists');
  }

  public function getWishlist()
  {
    $user = Auth::user();
    $userId = $user->id;
    $wishlists = '';
    $wishlists = Wishlist::with('user')
                        ->where('createdby_id', '=', $userId)
                        ->where('status', '=', 1)
                        ->orderBy('created_at', 'desc')
                        ->get();
    if(count($wishlists) > 0 || !empty($user))
      return view('userlayouts.wishlistProfile', compact('user', 'wishlists'));
  }

  public function addFriend($id)
  {
    $user = Auth::user();
    $userId = $user['id'];

    $exists = Friend::where('friend_userid', '=', $id)
                      ->where('userid', '=', $userId)
                      ->first();
    $exists2 = Friend::where('friend_userid', '=', $userId)
                      ->where('userid', '=', $id)
                      ->first();
    // echo $id, " ", $userId;
    // var_dump($exists);
    // var_dump($exists2);
    // die();
    if($exists == null && $exists2 == null){
      // var_dump($exists);
      // var_dump($exists2);
      // die();
      $friend = Friend::create(array(
        'friend_userid' => $id,
        'userid' => $userId,
        'date_added' => date("Y-m-d h:i:s"),
        'status' => 0,
        'seen' => 0,
      ));

      // $friend = new Friend(array(
      //   'friend_userid' => $id,
      //   'userid' => $userId,
      //   'date_added' => date("Y-m-d h:i:s"),
      //   'status' => 0,
      //   'seen' => 0,
      // ));
      //
      // $friend->save();
    }
    // else{
      // $exists = Friend::where('friend_userid', '=', $userId)
      //                   ->where('userid', '='. $id)
      //                   ->get();
      // if(!empty($exists)){
      //   $friend = new Friend(array(
      //     'friend_userid' => $id,
      //     'userid' => $userId,
      //     'date_added' => date("Y-m-d h:i:s"),
      //     'status' => 0,
      //     'seen' => 0,
      //   ));
      //
      //   $friend->save();
      // }
    // }

    return redirect()->action('UserProfilesController@profile', [$id]);
    // return redirect()->action('OtherUserController@profile', [$id]);
    // return redirect()->action('UserController@otheruser', [$id]);

  }

  public function unfriend($id)
  {
    $user = Auth::user();


    $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
    $friend = User::find($user->id)->friends;
    // print($friend);
    // die();

    if(!empty($friend)){
      foreach ($friend as $f) {
        if ($f->id == $id) {
          Friend::destroy($f->pivot->id);
        }
      }
    }

    // $friend->delete();

    return redirect()->action('UserProfilesController@profile', [$id]);
    // return redirect()->action('OtherUserController@profile', [$id]);
    // return redirect()->action('UserController@otheruser', [$id]);

  }

  public function cancelFriendRequest($id)
  {
    $user = Auth::user();

    $friendRequest = Friend::where('userid', '=', $user->id)
                            ->where('friend_userid', '=', $id)
                            ->where('status', '=', 0)
                            ->first();
    // print($friendRequest);
    // die();
    if(!empty($friendRequest))
      $friendRequest->delete();

    return redirect()->action('UserProfilesController@profile', [$id]);
    // return redirect()->action('OtherUserController@profile', [$id]);
    // return redirect()->action('UserController@otheruser', [$id]);

  }

  public function acceptFriendRequest($id)
  {
    $user = Auth::user();

    $friendRequest = Friend::where('id', '=', $id)
                            ->where('friend_userid','=', $user->id)
                            ->where('status', '=', 0)
                            ->first();
    // print($friendRequest);
    // die();
    if(!empty($friendRequest)){
      $friendRequest->date_accepted = date("Y-m-d h:i:s");
      $friendRequest->status = 1;

      $friendRequest->save();
    }

    return redirect()->action('UserController@notifications');
  }

  public function declineFriendRequest($id)
  {
    $user = Auth::user();

    $friendRequest = Friend::find($id)
                    ->where('friend_userid','=', $user->id)
                    ->where('status', '=', 0)
                    ->first();

    if(!empty($friendRequest))
      $friendRequest->delete();

    // dd($friendRequest);
    return redirect()->action('UserController@notifications');
  }

  public function getNoteRecipient()
  {
    $user = Auth::user();
    $userId = $user['id'];

    // $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
    // $recipient = User::find($userId)
    //                     ->friends
    //                     ->where('type', 1);

    $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
    $recipient = User::find($userId)->friends;
    // dd($recipient);
    return view('userlayouts.notesAction', compact('recipient', 'user'));
  }

  public function getTYNoteRecipient()
  {
    $user = Auth::user();
    $userId = $user['id'];

    // $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
    // $recipient = User::find($userId)
    //                     ->friends
    //                     ->where('type', 1);

    $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
    $recipient = User::find($userId)->friends;



    // dd($recipient);
    return view('userlayouts.tynotesAction', compact('recipient', 'user'));
  }

  public function createNoteModal(NotesRequest $request, $id)
  {
      $user = Auth::user();
      $userId = $user->id;

      $usersWithNotes = User::with('notesOf')->get();
      $withNotes = User::find($userId)->notesOf;

      foreach($withNotes as $note)
      {
        $notes = new Notes(array(
          'senderid' => $user->id,
          'receiverid' => $id,
          'message' => $request->get('message'),
          'type' => 0,
          'status' => 1,
        ));
      }
      // print($notes);
      $notes->save();
      return redirect('user/notes')->with('noteStatus', 'Note sent!');

  }

  public function createNote(NotesRequest $request)
  {
      $user = Auth::user();
      $userId = $user->id;
      // $receiver = User::find($userId)->friends;
      $note = new Notes(array(
        'senderid' => $user->id,
        'receiverid' => $request->recipient,
        'message' => $request->get('message'),
        'type' => 0,
        'status' => 1,
      ));
      $note->save();
      return redirect('user/action/notes')->with('noteStatus', 'Note sent!');
  }

  public function deleteNote($id)
  {
    $user = Auth::user();
    $userId = $user->id;
    $notes = Notes::where('id', $id)->firstorFail();

    $notes->status = 0;
    $notes->save();

    if(count($notes) > 1)
     return redirect('user/notes#tab-notes')->with('noteDelete', 'Note deleted!');
    else
     return redirect('user/notes#tab-notes')->with('errormsg', 'No Notes.');
  }


  public function createTYNote(NotesRequest $request)
  {
      $user = Auth::user();
      $userId = $user->id;
      $newImage = '';
      $newImage = Input::file('imageurl');
      // $hostURL = '192.168.1.28';
      $hostURL = 'images.wishare.net';
      if($newImage == null)
      {
        if($request->sticker == 1)
        {
          $tynote = new Notes(array(
            'senderid' => $user->id,
            'receiverid' => $request->recipient,
            'message' => $request->get('message'),
            'type' => 1,
            'status' => 1,
            'sticker' => 'http://' . $hostURL . '/tynotessticker/ty1.png',
            // 'sticker' => 'http://' . $hostURL . '/wishareimages/tynotessticker/ty1.png',
          ));
        }
        else if($request->sticker == 2)
        {
          $tynote = new Notes(array(
            'senderid' => $user->id,
            'receiverid' => $request->recipient,
            'message' => $request->get('message'),
            'type' => 1,
            'status' => 1,
            'sticker' => 'http://' . $hostURL . '/tynotessticker/ty2.png',
            // 'sticker' => 'http://' . $hostURL . '/wishareimages/tynotessticker/ty2.png',
          ));
        }
        else if($request->sticker == 3)
        {
          $tynote = new Notes(array(
            'senderid' => $user->id,
            'receiverid' => $request->recipient,
            'message' => $request->get('message'),
            'type' => 1,
            'status' => 1,
            'sticker' => 'http://' . $hostURL . '/tynotessticker/ty3.png',
            // 'sticker' => 'http://' . $hostURL . '/wishareimages/tynotessticker/ty3.png',
          ));
        }
        else
        {
          $tynote = new Notes(array(
            'senderid' => $user->id,
            'receiverid' => $request->recipient,
            'message' => $request->get('message'),
            'type' => 1,
            'status' => 1,
          ));
        }
      }
      else
      {
        if($request->sticker == 1)
        {
          $filename  = $user->id . time() . '.' . $newImage->getClientOriginalExtension();
          $path = ('/var/www/images.wishare.net/public_html/wishareimages/tynotesimages/' . $filename);
          // $path = ('C:/xampp/htdocs/wishareimages/tynotesimages/' . $filename);
          Image::make($newImage->getRealPath())->save($path);

          $tynote = new Notes(array(
            'senderid' => $user->id,
            'receiverid' => $request->recipient,
            'message' => $request->get('message'),
            'imageurl' => 'http://' . $hostURL . '/tynotesimages/'.$filename,
            // 'imageurl' => 'http://' . $hostURL . '/wishareimages/tynotesimages/'.$filename,
            'type' => 1,
            'status' => 1,
            'sticker' => 'http://' . $hostURL . '/tynotessticker/ty1.png',
            // 'sticker' => 'http://' . $hostURL . '/wishareimages/tynotessticker/ty1.png',
          ));
        }
        else if($request->sticker == 2)
        {
          $filename  = $user->id . time() . '.' . $newImage->getClientOriginalExtension();
          $path = ('/var/www/images.wishare.net/public_html/wishareimages/tynotesimages/' . $filename);
          // $path = ('C:/xampp/htdocs/wishareimages/tynotesimages/' . $filename);
          Image::make($newImage->getRealPath())->save($path);

          $tynote = new Notes(array(
            'senderid' => $user->id,
            'receiverid' => $request->recipient,
            'message' => $request->get('message'),
            'imageurl' => 'http://' . $hostURL . '/tynotesimages/'.$filename,
            // 'imageurl' => 'http://' . $hostURL . '/wishareimages/tynotesimages/'.$filename,
            'type' => 1,
            'status' => 1,
            'sticker' => 'http://' . $hostURL . '/tynotessticker/ty2.png',
            // 'sticker' => 'http://' . $hostURL . '/wishareimages/tynotessticker/ty2.png',
          ));
        }
        else
        {
          $filename  = $user->id . time() . '.' . $newImage->getClientOriginalExtension();
          $path = ('/var/www/images.wishare.net/public_html/wishareimages/tynotesimages/' . $filename);
          // $path = ('C:/xampp/htdocs/wishareimages/tynotesimages/' . $filename);
          Image::make($newImage->getRealPath())->save($path);

          $tynote = new Notes(array(
            'senderid' => $user->id,
            'receiverid' => $request->recipient,
            'message' => $request->get('message'),
            'imageurl' => 'http://' . $hostURL . '/tynotesimages/'.$filename,
            // 'imageurl' => 'http://' . $hostURL . '/wishareimages/tynotesimages/'.$filename,
            'type' => 1,
            'status' => 1,
            'sticker' => 'http://' . $hostURL . '/tynotessticker/ty3.png',
            // 'sticker' => 'http://' . $hostURL . '/wishareimages/tynotessticker/ty3.png',
          ));
        }
      }
     $tynote->save();
      // print($tynote);
     return redirect('user/action/tynotes')->with('tynoteStatus', 'Thank You Note sent!');
  }

  public function deleteTYNote($id)
  {
    $user = Auth::user();
    $userId = $user->id;
    $tynote = Notes::where('id', $id)->firstorFail();

    $tynote->status = 0;
    $tynote->save();

    if(count($tynote) > 1)
     return redirect('user/notes#tab-tynotes');
    else
     return redirect('user/notes#tab-tynotes')->with('errormsg', 'No Thank You Notes.');
  }

  public function deleteTYNoteProfile($id)
  {
    $user = Auth::user();
    $userId = $user->id;
    $tynote = Notes::where('id', $id)->firstorFail();

    $tynote->status = 0;
    $tynote->save();

    if(count($tynote) > 1)
     return redirect('user/profile#tab-ty');
    else
     return redirect('user/profile#tab-ty')->with('errormsg', 'No Thank You Notes.');
  }

  public function getAllNotes()
  {
    $user = Auth::user();
    $userId = $user->id;
    //notes tab
    $usersWithNotes = User::with('notesOf')->get();
    $notes = User::find($userId)->notesOf->reverse();
    //ty notes tab
    $usersWithTYNotes = User::with('tynotesOf')->get();
    $tynotes = User::find($userId)->tynotesOf->reverse();

    //outbox tab
    //notes
    $WithNotes = User::with('myNotes')->get();
    $notesOutbox = User::find($userId)->myNotes->reverse();
    // tynotes
    $WithTYNotes = User::with('myTYNotes')->get();
    $tynotesOutbox = User::find($userId)->myTYNotes->reverse();

    // dd($tynotes);
    if(!empty($notes) || !empty($tynotes) || !empty($notesOutbox) || !empty($tynotesOutbox))
    return view('userlayouts.notes', compact('notes', 'tynotes', 'notesOutbox', 'tynotesOutbox', 'user'));
  }

  public function reWish(RewishRequest $request, $id)
  {
    $user = Auth::user();

    $newImage = '';
    // $hostURL = '192.168.1.28';
    $hostURL = 'images.wishare.net';
    $newImage = Input::file('wishimageurl');

    if($newImage == null)
    {
      if($request->flag == null)
        $flag = 0;
      else
        $flag = 1;

      $wishTitle = Wish::where('id', $id)->firstorFail();

      $wish = new Wish(array(
        'wishlistid' => $request->wishlist,
        'title' => $wishTitle->title,
        'due_date' => $request->due_date,
        'createdby_id' => $user->id,
        'details' => $request->details,
        'alternatives' => $request->alternatives,
        'flagged' => $flag,
        'status' => 1,
      ));
    }
    else
    {
      $filename  = $user->id . time() . '.' . $newImage->getClientOriginalExtension();
      $path = ('/var/www/images.wishare.net/public_html/wishareimages/wishimages/' . $filename);
      // $path = ('C:/xampp/htdocs/wishareimages/wishimages/' . $filename);
      Image::make($newImage->getRealPath())->save($path);

      if($request->flag == null)
        $flag = 0;
      else
        $flag = 1;

      $wishTitle = Wish::where('id', $id)->firstorFail();
      $wish = new Wish(array(
        'wishlistid' => $request->wishlist,
        'title' => $wishTitle->title,
        'due_date' => $request->due_date,
        'createdby_id' => $user->id,
        'details' => $request->details,
        'alternatives' => $request->alternatives,
        'flagged' => $flag,
        'wishimageurl' => 'http://' . $hostURL . '/wishimages/'.$filename,
        // 'wishimageurl' => 'http://' . $hostURL . '/wishareimages/wishimages/'.$filename,
        'status' => 1,
      ));

    }

    $wish->save();

    if (!empty($request->tags)) {
      foreach ($request->tags as $t) {
        $tag = new Tag(array(
          'wishid' => $wish->id,
          'userid' => $t,
        ));
        $tag->save();
      }
    }

    return redirect('user/home');
  }

  public function rewishDetails($id)
  {
    $user = Auth::user();
    $userId = $user->id;
    $wish = Wish::where('id', '=', $id)->first();
    $tags = Tag::with('user')->where('wishid', '=', $id)->get();
    $wishlists = Wishlist::with('wishes')->where('createdby_id', '=', $userId)->where('status', '=', 1)
                      ->lists('title', 'id');
    $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
    $friends = User::find($userId)->friends;

    return view('userlayouts.rewish', compact('wish', 'tags', 'wishlists', 'friends', 'user'));
  }

  public function grantWish(GrantWishRequest $request, $id)
  {
    $user = Auth::user();
    $userId = $user->id;
    $newImage = '';
    // $hostURL = '192.168.1.28';
    $hostURL = 'images.wishare.net';
    $newImage = Input::file('grantedimageurl');

    $wish = Wish::where('id', '=', $id)->where('status', '=', 1)->first();

    $request->granterid = $userId;

    if($request->granterid == $wish->createdby_id)
    {
      // dd($userId);
      if($newImage == null)
      {
        if($request->flag == null)
          $flag = 0;
        else
          $flag = 1;

        $wishDetails = Wish::where('id', '=', $id)->where('status', '=', 1)->first();

        if (!empty($wishDetails)) {
          $wishDetails->wishlistid = $wishDetails->wishlistid;
          $wishDetails->title = $wishDetails->title;
          $wishDetails->createdby_id = $wishDetails->createdby_id;
          $wishDetails->details = $wishDetails->details;
          $wishDetails->wishimageurl = $wishDetails->wishimageurl;
          $wishDetails->alternatives = $wishDetails->alternatives;
          $wishDetails->due_date = $wishDetails->due_date;
          $wishDetails->granted = 1;
          $wishDetails->granterid = $user->id;
          $wishDetails->granteddetails = $request->granteddetails;
          $wishDetails->date_granted = date('Y-m-d H:i:s');
          $wishDetails->flagged = $flag;
          $wishDetails->status = 1;
          // dd($wishDetails);
          $wishDetails->save();
        }
      }
      else
      {
        $filename  = $user->id . time() . '.' . $newImage->getClientOriginalExtension();
        $path = ('/var/www/images.wishare.net/public_html/wishareimages/wishimages/' . $filename);
        // $path = ('C:/xampp/htdocs/wishareimages/wishimages/' . $filename);
        Image::make($newImage->getRealPath())->save($path);

        if($request->flag == null)
          $flag = 0;
        else
          $flag = 1;

        $wishDetails = Wish::where('id', $id)->firstorFail();

        if (!empty($wishDetails)) {
          $wishDetails->wishlistid = $wishDetails->wishlistid;
          $wishDetails->title = $wishDetails->title;
          $wishDetails->createdby_id = $wishDetails->createdby_id;
          $wishDetails->details = $wishDetails->details;
          $wishDetails->wishimageurl = $wishDetails->wishimageurl;
          $wishDetails->alternatives = $wishDetails->alternatives;
          $wishDetails->due_date = $wishDetails->due_date;
          $wishDetails->granted = 1;
          $wishDetails->granterid = $user->id;
          $wishDetails->granteddetails = $request->granteddetails;
          $wishDetails->grantedimageurl = 'http://' . $hostURL . '/wishimages/'.$filename;
          // $wishDetails->grantedimageurl = 'http://' . $hostURL . '/wishareimages/wishimages/'.$filename;
          $wishDetails->date_granted = date('Y-m-d H:i:s');
          $wishDetails->flagged = $flag;
          $wishDetails->status = 1;
          // dd($wishDetails);
          $wishDetails->save();
        }
      }
    }
    else if($wish->granterid != $wish->createdby_id)
    {
      if($newImage == null)
      {
        if($request->flag == null)
          $flag = 0;
        else
          $flag = 1;

        $wishDetails = Wish::where('id', '=', $id)->where('status', '=', 1)->first();

        if (!empty($wishDetails)) {
          $wishDetails->wishlistid = $wishDetails->wishlistid;
          $wishDetails->title = $wishDetails->title;
          $wishDetails->createdby_id = $wishDetails->createdby_id;
          $wishDetails->details = $wishDetails->details;
          $wishDetails->wishimageurl =  $wishDetails->wishimageurl;
          $wishDetails->alternatives = $wishDetails->alternatives;
          $wishDetails->due_date = $wishDetails->due_date;
          $wishDetails->granted = 0;
          // $wishDetails->granted = 2;
          $wishDetails->granterid = $user->id;
          $wishDetails->granteddetails = $request->granteddetails;
          // $wishDetails->grantedimageurl = '';
          $wishDetails->flagged = $flag;
          $wishDetails->status = 1;
          // dd($wishDetails);
          $wishDetails->save();
        }
      }
      else
      {
        $filename  = $user->id . time() . '.' . $newImage->getClientOriginalExtension();
        $path = ('/var/www/images.wishare.net/public_html/wishareimages/wishimages/' . $filename);
        // $path = ('C:/xampp/htdocs/wishareimages/wishimages/' . $filename);
        Image::make($newImage->getRealPath())->save($path);

        if($request->flag == null)
          $flag = 0;
        else
          $flag = 1;

        $wishDetails = Wish::where('id', $id)->firstorFail();

        if (!empty($wishDetails)) {
          $wishDetails->wishlistid = $wishDetails->wishlistid;
          $wishDetails->title = $wishDetails->title;
          $wishDetails->createdby_id = $wishDetails->createdby_id;
          $wishDetails->details = $wishDetails->details;
          $wishDetails->wishimageurl = $wishDetails->wishimageurl;
          $wishDetails->alternatives = $wishDetails->alternatives;
          $wishDetails->due_date = $wishDetails->due_date;
          $wishDetails->granted = 0;
          // $wishDetails->granted = 2;
          $wishDetails->granterid = $user->id;
          $wishDetails->granteddetails = $request->granteddetails;
          $wishDetails->grantedimageurl = 'http://' . $hostURL . '/wishimages/'.$filename;
          // $wishDetails->grantedimageurl = 'http://' . $hostURL . '/wishareimages/wishimages/'.$filename;
          $wishDetails->flagged = $flag;
          $wishDetails->status = 1;
          // dd($wishDetails);
          $wishDetails->save();
        }
      }
    }
    else
    {
      $check = '';
    }
    if (!empty($request->tags)) {
      foreach ($request->tags as $t) {
        $tag = new Tag(array(
          'wishid' => $wishDetails->id,
          'userid' => $t,
        ));
        $tag->save();
      }
    }

    if($wishDetails->granterid != $wishDetails->createdby_id)
      return redirect('user/home')->with('homeAlert', 'Grant request sent!');
    else
      return redirect('user/home');
  }

  public function confirmGrantRequest($id)
  {
    $user = Auth::user();

    // $grantRequest = Wish::where('id', '=', $id)
    //         ->where('status', '=', 1)
    //         ->where('granted', '=', 2)
    //         ->first();
    $grantRequest = Wish::where('id', '=', $id)
            ->where('status', '=', 1)
            ->where('granted', '=', 0)
            ->where('granterid', '!=', 0)
            ->first();

      // dd($grantRequest);
    if(!empty($grantRequest)){
      $grantRequest->date_granted = date("Y-m-d h:i:s");
      $grantRequest->granted = 1;

      $grantRequest->save();
    }

    return redirect()->action('UserController@notifications');
  }

  public function declineGrantRequest($id)
  {
    $user = Auth::user();

    $grantRequest = Wish::where('id', '=', $id)
            ->where('status', '=', 1)
            ->where('granted', '=', 0)
            ->where('granterid', '!=', 0)
            ->first();

    if(!empty($grantRequest))
    {
      $grantRequest->granted = 0;
      $grantRequest->granterid = 0;

      $grantRequest->save();
    }

    // dd($friendRequest);
    return redirect()->action('UserController@notifications');
  }

  public function setUsernameAndPassword()
  {
    $user = Auth::user();

    // if(!empty($user->password) && !empty($user->username))
    if(!empty($user->password) && $user->username != null)
      return view('userlayouts.setPassAndUsername');
    else {
      return redirect()->action('UserController@home');
    }
  }
}

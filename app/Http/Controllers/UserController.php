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
use App\Wishlist;
use App\User;
use App\DefaultWishlist;
use App\Friend;
use Input;
use Image;
use Session;
use Hash;
use Auth;
use Redirect;

class UserController extends Controller
{
  // public function __construct()
  // {
  //     $this->middleware('auth');
  //
  // }

  public function dashboard()
  {
    return view('userlayouts-master.user-master');
  }

  public function home()
  {
    $user = Auth::user();

    if (!empty(Auth::user()->password)){
      return view('userlayouts.home');
    }
    else {
      return redirect('user/setPassword');
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
      return view('userlayouts.searchFriend', compact('results'));
    // else{
      // return view('userlayouts.searchFriend')->with('errormsg', 'Not found');
    // }
  }

  public function setPassword()
  {
      return view('userlayouts.setPassword');
  }

  public function notifications()
  {
    $user = Auth::user();

    $requests = Friend::with('friendRequest')->where('status', '=', '0')->get();

   return view('userlayouts.notifications', compact('requests'));
  }
  public function notes()
  {
    return view('userlayouts.notes');
  }
  public function wish()
  {
    return view('userlayouts.wish');
  }

  public function deactivate()
  {
    return view('userlayouts.deactivate');
  }
  public function help()
  {
    return view('userlayouts.help');
  }
  public function changepass()
  {
    $user = Auth::user();

    if (!empty(Auth::user()->password)){
      return view('userlayouts.changepass');
      // return view('userlayouts.home');
    }
    else {
      return redirect('user/setPassword');
    }
    // return view('userlayouts.changepass');
  }
  public function wishlistAction()
  {
    return view('userlayouts.wishlistAction');
  }
  public function wishAction()
  {
    return view('userlayouts.wishAction');
  }
  public function notesAction()
  {
    return view('userlayouts.notesAction');
  }
  public function tynotesAction()
  {
    return view('userlayouts.tynotesAction');
  }
  /* Other user */
  public function otheruser($id)
  {
    $user = Auth::user();
    $userId = $user->id;

    if($user->id != $id){
      $otherUser = User::where('id', '=', $id)->firstorFail();

      $requests = Friend::with('friendRequest')
                          ->where('userid', '=', $otherUser->id)
                          ->where('friend_userid', '=', $userId)
                          ->where('status', '=', 0)
                          ->get();
      // print($requests);
      // die();

      $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
      $friends = User::find($otherUser->id)->friends;
      // print($friend);
      // die();
      // if(count($friends)==0){
      $friendRequest = Friend::where('userid', '=', $user->id)
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

          return view('otheruser.otheruserprivate', compact('otherUser', 'friends', 'status', 'requests'));
      }
      else {
          return view('otheruser.otheruserprofile', compact('otherUser', 'friends', 'status', 'requests'));
      }
    }
    else {
      return redirect()->action('UserController@getUserDetails');
    }
  }

  public function store(UserRequest $request)
  {

    $user = new User(array(
      'imageurl' => 'img/userImages/default.jpg',
      'lastname' => trim($request->lastname),
      'firstname' => trim($request->firstname),
      'username' => trim($request->username),
      'email' => trim($request->email),
      'privacy' => 0,
      'type' => 1,
      'status' => 1,
      'defaultwishlist' => 0,
      'password' => trim(bcrypt($request->get('password'))),
    ));

    $user->save();

    //========= get default wishlists and store to users wishlists
    if(!Auth::check()){
      if (Auth::attempt(['email' => $request['email'], 'password' => $request['password'], 'status' => 1]))
      {
        $user = User::where('email', $request['email'])->firstorFail();
        $type = $user->type;
        $status = $user->status;
        // var_dump($user);

        $defaultwishlists = DefaultWishlist::where('status', '=', 1)
                                            ->orderBy('created_at', 'desc')
                                            ->get();

        // var_dump($defaultwishlists);

        foreach ($defaultwishlists as $dw) {

          $wishlist = new Wishlist(array(
            'title' => $dw->title,
            'createdby_id' => $user->id,
            'privacy' => 0,
            'status' => 1,
          ));

          $wishlist->save();
        }

        $user->defaultwishlist = 1;

        $user->save();


        return view('userlayouts.home');

      }
    }
    else {
      print("Not logged in");
    }

    // return redirect('/user/home');
  }

  public function getUserDetails()
  {
    //profile details
    $user = Auth::user();
    $userId = $user->id;
    //var_dump($user);
    //

    //wishlist
    $wishlists = '';
    $wishlists = Wishlist::with('user')
                        ->where('createdby_id', '=', $userId)
                        ->where('status', '=', 1)
                        ->orderBy('created_at', 'desc')
                        ->get();

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

      // dd($user);

    //  dd($friends);
    if(count($wishlists) > 0 || !empty($user) || !empty($friends))
      return view('userlayouts.profile', compact('user', 'wishlists', 'friends'));
    // /var_dump($wishlists);


  }

  public function editSettings()
  {
    $user = Auth::user();
    $id = $user->id;
    //$user = User::where('id', $id)->first();
    //var_dump($user);
    return view('userlayouts.settings', compact('user'));
  }

  public function updateUserSettings(SettingRequest $request)
  {
    //$user = User::where('id', $id);
    $user = Auth::user();
    $id = $user->id;


    $user->firstname = $request->get('firstname');
    $user->lastname = $request->get('lastname');
    $user->city = $request->get('city');
    $user->username = $request->get('username');
    $user->email = $request->get('email');
    $user->facebook = $request->get('facebook');
    $user->birthdate = $request->get('birthdate');
    $user->privacy = $request->privacy;

    $user->save();

    //return redirect(action('userController@editSettings', $user->id))->with('status', 'Saved.');
    return redirect('user/settings')->with('status', 'Saved!');
  }

  public function updateProfilePic()
  {
    $user = Auth::user();
    $id = $user->id;
    $newImage = '';
    $newImage = Input::file('imageurl');
    $filename  = $user->id . time() . '.' . $newImage->getClientOriginalExtension();
    // dd($filename);

    $path = public_path('img/userImages/' . $filename);
    Image::make($newImage->getRealPath())->fit(150, 150)->save($path);
    $user->imageurl = 'img/userImages/'.$filename;

    $user->save();

    //return redirect(action('userController@editSettings', $user->id))->with('status', 'Saved.');
    return redirect('user/settings#tab-pic')->with('status', 'Saved!');
  }

  public function updateToSetPassword(SetPasswordRequest $request)
  {
    $user = Auth::user();

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
    return redirect('user/profile#tab-wishes')->with('wishlistSettings', 'Wishlist udpated successfully!');
  }

  public function deleteWishlist($id)
  {
    $user = Auth::user();
    $wishlist = Wishlist::where('id', $id)->firstorFail();
    $wishlist->status = 0;
    $wishlist->save();

     if(count($wishlist) > 1)
      return redirect('user/profile#tab-wishes')->with('wishlistDelete', 'Wishlist deleted!');
     else
       return redirect('user/profile#tab-wishes')->with('errormsg', 'No Wishlists.');
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
      return view('userlayouts.profile', compact('user', 'wishlists'));
  }

  public function addFriend($id)
  {
    $user = Auth::user();

    $friend = new Friend(array(
      'friend_userid' => $id,
      'userid' => $user->id,
      'date_added' => date("Y-m-d h:i:s"),
      'status' => 0,
      'seen' => 0,
    ));
    // dd($friend);
    $friend->save();

    return redirect()->action('UserController@otheruser', [$id]);

  }

  public function unfriend($id)
  {
    $user = Auth::user();


    $usersWithFriends = User::with('friendsOfMine', 'friendOf')->get();
    $friend = User::find($user->id)->friends;

    foreach ($friend as $f) {
      if ($f->id == $id) {
        Friend::destroy($f->pivot->id);
      }
    }


    // $friend->delete();

    return redirect()->action('UserController@otheruser', [$id]);

  }

  public function cancelFriendRequest($id)
  {
    $user = Auth::user();

    $friendRequest = Friend::where('userid', '=', $user->id)
                            ->where('friend_userid', '=', $id)
                            ->firstorFail();
    // var_dump($friendRequest);

    $friendRequest->delete();

    return redirect()->action('UserController@otheruser', [$id]);

  }

  public function acceptFriendRequest($id)
  {
    $user = Auth::user();

    $friendRequest = Friend::where('id', '=', $id)->where('friend_userid','=', $user->id)->first();
    // print($friendRequest);
    // die();
    $friendRequest->date_accepted = date("Y-m-d h:i:s");
    $friendRequest->status = 1;

    $friendRequest->save();


    return redirect()->action('UserController@notifications');
  }

  public function declineFriendRequest($id)
  {
    $user = Auth::user();

    $friendRequest = Friend::find($id)->where('friend_userid','=', $user->id)->first();

    $friendRequest->delete();

    // dd($friendRequest);
    return redirect()->action('UserController@notifications');
  }

  public function sidebarNotification()
  {
    $user = Auth::user();

    $requests = Friend::with('friendRequest')->where('status', '=', '0')->get();
    // dd($requests);
    return view('userlayouts-master.user-master', compact('requests'));
  }
}

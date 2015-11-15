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

  public function setPassword()
  {
      return view('userlayouts.setPassword');
  }

  public function notifications()
  {
    return view('userlayouts.notifications');
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
  public function otheruser()
  {
    return view('otheruser.otheruserprofile');
  }

  public function store(UserRequest $request)
  {

    $user = new User(array(
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

    if(count($wishlists) > 0)
      return view('userlayouts.profile', compact('user', 'wishlists'));
    else
      return view('userlayouts.profile')->with('errormsg', "No Wishlists.");
    ///var_dump($wishlists);


  }

  public function editSettings($id)
  {
    $user = Auth::user();
    //$user = User::where('id', $id)->first();
    //var_dump($user);
    return view('userlayouts.settings', compact('user'));
  }

  public function updateUserSettings(SettingRequest $request, $id)
  {
    //$user = User::where('id', $id);
    $user = Auth::user();

    $newImage = '';
    $newImage = Input::file('imageurl');
    $filename  = 'user' . $user->id . '.' . $newImage->getClientOriginalExtension();
    $path = public_path('img/userImages/' . $filename);
    Image::make($newImage->getRealPath())->fit(150, 150)->save($path);
    $user->imageurl = 'img/userImages/'.$filename;
    //$userPic = $user->imageurl;

    $user->firstname = $request->get('firstname');
    $user->lastname = $request->get('lastname');
    $user->city = $request->get('city');
    $user->username = $request->get('username');
    $user->email = $request->get('email');
    $user->facebook = $request->get('facebook');
    $user->birthdate = $request->get('birthdate');

    $user->save();

    //return redirect(action('userController@editSettings', $user->id))->with('status', 'Saved.');
    return redirect('user/settings/profile')->with('status', 'Saved!');
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
    return redirect('user/profile#tab-wishes')->with('wishlistDelete', 'Wishlist deleted!');
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

    if(count($wishlists) > 0)
      return view('userlayouts.wishlistProfile', compact('user', 'wishlists'));
    else
      return view('userlayouts.wishlistProfile')->with('errormsg', "No Wishlists.");
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
// use Illuminate\Contracts\Auth\Authenticatable;
 // use Laravel\Socialite\Contracts\Factory as Socialite;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Auth;
use Session;
use App\User;
use App\DefaultWishlist;
use App\Wishlist;

class AuthController extends Controller implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{

  use Authenticatable, Authorizable, CanResetPassword;
  
  public function __construct()
  {
      // $this->middleware('auth');

      $this->middleware('guest', ['except' => 'signout']);
  }

  public function store(UserRequest $request)
  {

    $user = new User(array(
      'imageurl' => 'http://images.wishare.net/userimages/default.jpg',
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
        $user = User::where('email', $request['email'])->first();
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


        return redirect()->action('UserController@postSignup');
        // return view('userlayouts.home');

      }
    }
    else {
      print("Not logged in");
    }

    // return redirect('/user/home');
  }

  public function redirectToProvider()
  {
      return Socialite::driver('facebook')->redirect();
  }

  public function handleProviderCallback()
  {
      try {
          $user = Socialite::driver('facebook')->user();
      } catch (Exception $e) {
          return redirect('login/facebook');
      }
      
      $authUser = $this->findOrCreateUser($user);
      // dd($authUser);
      if(!is_null($authUser)){
        Auth::login($authUser, true);
        // Auth::login($authUser);
        // Auth::loginUsingId($authUser->id);
      }
      else{
        return redirect()->action('PagesController@fbemailerror');
      }
      
      $user = Auth::user();

      if($user->defaultwishlist == 0){


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
      }

      // return redirect('user/home');
      if ($user->username == null && empty($user->password)) {
        return redirect()->action('UserController@setUsernameAndPassword');
      }
      else{
        return redirect()->action('UserController@postSignup');
      }
// return redirect()->route('user.home');


      // var_dump($authUser);
      // die;
      // $user->token;
      // return redirect('/user/home');
  }

  private function findOrCreateUser($fbUser)
  {
    
    if ($authUser = User::where('fb_id', $fbUser->id)->first()) {
        // echo "1";
        // dd($authUser);
        return $authUser;
    }

    if ($authUser = User::where('email', $fbUser->email)->where('fb_id', null)->first()) {
        $authUser->fb_id = $fbUser->id;
        $authUser->save();
        // echo "2";
        // dd($authUser);
        return $authUser;
    }
    // $username = preg_replace('/\s/', '', $fbUser->firstname) . $fbUser->id;
    // else{
    // echo "3";
    // dd($fbUser);
    if ($fbUser->email !== null) {
      // echo "3";
      // dd($fbUser->email);
      return User::create([
        'fb_id' => $fbUser->id,
        'lastname' => $fbUser->lastname,
        'firstname' => $fbUser->firstname,
        // 'username' => $username,
        'email' => $fbUser->email,
        'imageurl' => $fbUser->avatar,
        'privacy' => 0,
        'type' => 1,
        'status' => 1,
        'defaultwishlist' => 0,
      ]);
    }
    // else{
    //   // echo "4";
    //   // dd($fbUser);
    //   return redirect()->action('PagesController@fbemailerror');
    // }     
    // dd($authUser);
    return $authUser;
  }

  // public function __construct(Socialite $socialite){
  //      $this->socialite = $socialite;
  //  }
  //
  //  public function getSocialAuth($provider=null)
  //    {
  //        if(!config("services.$provider")) abort('404'); //just to handle providers that doesn't exist
  //
  //        return $this->socialite->with($provider)->redirect();
  //    }
  //
  //
  //    public function getSocialAuthCallback($provider=null)
  //    {
  //       if($user = $this->socialite->with($provider)->user()){
  //          dd($user);
  //       }else{
  //          return 'something went wrong';
  //       }
  //    }


  public function signin(Request $request)
  {

      if(!Auth::check())
      {

          if (Auth::attempt(['email' => $request['email'], 'password' => $request['password'], 'status' => 1]))
          {
            $user = User::where('email', $request['email'])->first();
            $type = $user->type;
            $status = $user->status;

              if($type == '0'){
                  // dd($user);
                  // return redirect('/admin');
                  return redirect()->action('AdminController@index');
              }
              else{
                return redirect()->action('UserController@postSignup');
                  // return redirect('/user/home');
              }
                  

          }
          else
          {
              $user = User::where('email', $request['email'])->first();
              if(!empty($user)){
                $status = $user->status;

                if ($status == '0') {
                  $request->flash();
                  Session::flash('flash_message', 'This account has been deactivated.');
                  return redirect('/reactivate');
                }
                else {
                  $request->flash();
                  Session::flash('flash_message', 'Invalid email or password.');
                  return redirect('/signin');
                }
              }
              else{
                $request->flash();
                Session::flash('flash_message', 'Please Sign Up or Connect to wishare with Facebook.');
                return redirect('/signin');
              }
          }
      }
      else
      {
          return redirect('/signin');
      }
  }

  public function signout()
  {
      Auth::logout();
      return redirect('/');
  }
}

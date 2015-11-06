<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Http\Requests;
use App\Http\Controllers\Controller;
 // use Laravel\Socialite\Contracts\Factory as Socialite;


use Auth;
use Session;
use App\User;

class AuthController extends Controller
{

  public function __construct()
  {
      // $this->middleware('auth');

      $this->middleware('guest', ['except' => 'signout']);
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

      Auth::login($authUser, true);

      return redirect('user/home');
      // return redirect()->route('user.home');


      // var_dump($authUser);
      // die;
      // $user->token;
      // return redirect('/user/home');
  }

  private function findOrCreateUser($fbUser)
    {
        if ($authUser = User::where('fb_id', $fbUser->id)->first()) {
            // var_dump($authUser);
            return $authUser;
        }
        // else{
          return User::create([
            'fb_id' => $fbUser->id,
            'lastname' => $fbUser->lastname,
            'firstname' => $fbUser->firstname,
            'username' => $fbUser->name,
            'email' => $fbUser->email,
            'privacy' => 0,
            'type' => 1,
            'status' => 1,
          ]);
        // }
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

          if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']]))
          {
            $user = User::where('email', $request['email'])->firstorFail();
            $type = $user->type;


            if($type == '0')
                return redirect('/admin');
            else
                return redirect('/user/home');
          }
          else
          {
              $request->flash();
              Session::flash('flash_message', 'Invalid email or password.');
              return redirect('/signin');
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

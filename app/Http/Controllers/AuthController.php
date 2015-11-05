<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Session;
use App\User;

class AuthController extends Controller
{
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
                return redirect('/admin');
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

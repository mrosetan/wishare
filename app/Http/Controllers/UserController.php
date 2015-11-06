<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\UserRequest;
use App\User;
use Auth;

class UserController extends Controller
{

  public function dashboard()
  {
    return view('userlayouts-master.user-master');
  }

  public function home()
  {
    return view('userlayouts.home');
  }

  public function profile()
  {
    return view('userlayouts.profile');
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
      'password' => trim(bcrypt($request->get('password'))),
    ));

    $user->save();

    return redirect('/user/home');
  }
}

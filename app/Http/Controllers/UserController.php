<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
  public function settings()
  {
    return view('userlayouts.settings');
  }
  public function help()
  {
    return view('userlayouts.help');
  }
  /* Other user */
  public function otheruser()
  {
    return view('otheruser.otheruserprofile');
  }
}

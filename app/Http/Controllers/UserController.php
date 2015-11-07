<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\SettingRequest;
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

  public function changePass()
  {
    return view('userlayouts.changepass');
  }

  public function deactivate()
  {
    return view('userlayouts.deactivate');
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

  public function getUserDetails($id)
  {
    $users = User::where('id', '=', $id)
                ->where('status', '=', 1)
                ->get();
    return view('userlayouts.settings', compact('users'));
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

    if($request->get('firstname') != '')
    {
        $user->firstname = $request->get('firstname');
    }

    if($request->get('lastname') != '')
    {
        $user->lastname = $request->get('lastname');
    }

    if($request->get('city') != '')
    {
      $user->city = $request->get('city');
    }

    if($request->get('facebook') != '')
    {
      $user->facebook = $request->get('facebook');
    }

    if($request->get('birthdate') != '')
    {
      $user->birthdate = $request->get('birthdate');
    }

    $user->save();

    //return redirect(action('userController@editSettings', $user->id))->with('status', 'Saved.');
    return redirect('user/settings/profile')->with('status', 'Saved!');
  }
}

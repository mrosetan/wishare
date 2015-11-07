<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\UserRequest;
use App\User;
use Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth');

     }

    public function index()
    {
      if (Auth::user()->type == 0) {
        return view('admin.master');
      }
      else{
        return redirect('blank');
      }

    }

    public function reports()
    {
      return view('admin.reports');
    }

    public function monitorUsers()
    {
      $users = User::where('status', '=', 1)
                    ->where('type', '=', 1)
                    ->orderBy('created_at', 'desc')
                    ->get();
      // print_r($users);
      return view('admin.monitoringUsers', compact('users'));
    }

    public function monitorWishes()
    {
      return view('admin.monitoringWishes');
    }

    public function monitorWishlists()
    {
      return view('admin.monitoringWishlists');
    }

    public function createAdmin()
    {
      return view('admin.createAdmin');
    }

    public function createDefaultWishlist()
    {
      return view('admin.createDefaultWishlist');
    }

    public function viewAdmins()
    {
      return view('admin.viewAdmins');
    }

    public function viewDefaultWishlists()
    {
      return view('admin.viewDefaultWishlists');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(UserRequest $request)
    // {
    //
    //   $user = new User(array(
    //     'lastname' => trim($request->lastname),
    //     'firstname' => trim($request->firstname),
    //     'username' => trim($request->username),
    //     'email' => trim($request->email),
    //     'privacy' => 0,
    //     'type' => 1,
    //     'status' => 1,
    //     'password' => trim(bcrypt($request->get('password'))),
    //   ));
    //
    //   $user->save();
    //
    //   return redirect('/user/home');
    // }

    public function storeAdmin(UserRequest $request)
    {


      $user = new User(array(
        'lastname' => trim($request->lastname),
        'firstname' => trim($request->firstname),
        'username' => trim($request->username),
        'email' => trim($request->email),
        'privacy' => 0,
        'type' => 0,
        'status' => 1,
        'password' => trim(bcrypt($request->get('password'))),
      ));

      $user->save();

      return redirect('/admin/view/admins');
    }

    public function showAdmins()
    {

        $users = User::where('status', '=', 1)
                      ->where('type', '=', 0)
                      ->orderBy('created_at', 'desc')
                      ->get();
        // print_r($users);
        return view('admin.viewAdmins', compact('users'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editAdmin($id)
    {
      $user = User::where('id', $id)->first();
      return view('admin.editAdmin', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAdmin(UserRequest $request, $id)
    {
      $user = User::where('id', $id)->first();

      if($request->get('firstname') != '')
      {
          $user->firstname = $request->get('firstname');
      }

      if($request->get('lastname') != '')
      {
          $user->lastname = $request->get('lastname');
      }

      if($request->get('password') != '')
      {
        $user->password = bcrypt($request->get('password'));
      }

      if($request->get('username') != '')
      {
          $user->username = $request->get('username');
      }

      if($request->get('email') != '')
      {
          $user->email = $request->get('email');
      }

      $user->save();

      return redirect(action('AdminController@editAdmin', $user->id))->with('status', 'Admin updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteAdmin($id)
    {
        $user = User::where('id', $id)->firstorFail();

        $user->status = 0;

        $user->save();

        $users = User::where('status', '=', 1)
                      ->where('type', '=', 0)
                      ->orderBy('created_at', 'desc')
                      ->get();

        // print($id);
        return view('admin.viewAdmins', compact('users'));

    }

    public function deactivateUser($id)
    {
        $user = User::where('id', $id)->firstorFail();

        $user->status = 0;

        $user->save();

        $users = User::where('status', '=', 1)
                      ->where('type', '=', 0)
                      ->orderBy('created_at', 'desc')
                      ->get();

        // print($id);
        return view('admin.monitoringUsers', compact('users'));

    }
}

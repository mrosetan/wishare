<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\UserRequest;
use App\Http\Requests\EditAdminRequest;
use App\Http\Requests\DefaultWishlistRequest;
use App\User;
use App\DefaultWishlist;
use App\Wishlist;
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
        return redirect('user/home');
      }

    }

    public function reports()
    {
      if (Auth::user()->type == 0) {
        return view('admin.reports');
      }
      else
        return redirect('user/home');
    }

    public function monitorUsers()
    {

      if (Auth::user()->type == 0) {
        $users = User::where('status', '=', 1)
                      ->where('type', '=', 1)
                      ->orderBy('created_at', 'desc')
                      ->get();
        // print_r($users);
        return view('admin.monitoringUsers', compact('users'));
      }
      else
        return redirect('user/home');

      // $users = User::where('status', '=', 1)
      //               ->where('type', '=', 1)
      //               ->orderBy('created_at', 'desc')
      //               ->get();
      // // print_r($users);
      // return view('admin.monitoringUsers', compact('users'));
    }

    public function monitorWishes()
    {

      if (Auth::user()->type == 0) {
        return view('admin.monitoringWishes');
      }
      else
        return redirect('user/home');

    }

    public function monitorWishlists()
    {
      if (Auth::user()->type == 0) {
        // $wishlists = Wishlist::where('status', '=', 1)
        //               ->orderBy('created_at', 'desc')
        //               ->get();
        $wishlists = Wishlist::with('user')
                              ->orderBy('created_at', 'desc')
                              ->get();
        // print_r($wishlists);
        // die();
        return view('admin.monitoringWishlists', compact('wishlists'));
      }
      else
        return redirect('user/home');

    }

    public function createAdmin()
    {
      if (Auth::user()->type == 0) {
        return view('admin.createAdmin');
      }
      else
        return redirect('user/home');

    }

    public function createDefaultWishlist()
    {
      if (Auth::user()->type == 0) {
        return view('admin.createDefaultWishlist');
      }
      else
        return redirect('user/home');
      // return view('admin.createDefaultWishlist');
    }

    public function viewAdmins()
    {
      if (Auth::user()->type == 0) {
        return view('admin.viewAdmins');
      }
      else
        return redirect('user/home');
      // return view('admin.viewAdmins');
    }

    public function viewDefaultWishlists()
    {

      if (Auth::user()->type == 0) {
        $defaultwishlists = DefaultWishlist::where('status', '=', 1)
                                            ->orderBy('created_at', 'desc')
                                            ->get();

        return view('admin.viewDefaultWishlists', compact('defaultwishlists'));
      }
      else
        return redirect('user/home');
      // $defaultwishlists = DefaultWishlist::where('status', '=', 1)
      //                                     ->orderBy('created_at', 'desc')
      //                                     ->get();
      //
      // return view('admin.viewDefaultWishlists', compact('defaultwishlists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeDefaultWishlist(DefaultWishlistRequest $request)
    {
      $dw = new DefaultWishlist(array(
        'title' => trim($request->title),
        'status' => 1,
      ));

      $dw->save();

      return redirect('/admin/view/defaultwishlists');
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
      if (Auth::user()->type == 0) {
        $users = User::where('status', '=', 1)
                      ->where('type', '=', 0)
                      ->orderBy('created_at', 'desc')
                      ->get();
        // print_r($users);
        return view('admin.viewAdmins', compact('users'));
      }
      else
        return redirect('user/home');

        // $users = User::where('status', '=', 1)
        //               ->where('type', '=', 0)
        //               ->orderBy('created_at', 'desc')
        //               ->get();
        // // print_r($users);
        // return view('admin.viewAdmins', compact('users'));

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
      if (Auth::user()->type == 0) {
        $user = User::where('id', $id)->first();
        return view('admin.editAdmin', compact('user'));
      }
      else
        return redirect('user/home');

      // $user = User::where('id', $id)->first();
      // return view('admin.editAdmin', compact('user'));
    }

    public function editDefaultWishlist($id)
    {
      if (Auth::user()->type == 0) {
        $defaultwishlist = DefaultWishlist::where('id', $id)->first();
        return view('admin.editDefaultWishlist', compact('defaultwishlist'));
      }
      else
        return redirect('user/home');

      // $defaultwishlist = DefaultWishlist::where('id', $id)->first();
      // return view('admin.editDefaultWishlist', compact('defaultwishlist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAdmin(EditAdminRequest $request, $id)
    {

      if (Auth::user()->type == 0) {
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
      else
        return redirect('user/home');

      // $user = User::where('id', $id)->first();
      //
      // if($request->get('firstname') != '')
      // {
      //     $user->firstname = $request->get('firstname');
      // }
      //
      // if($request->get('lastname') != '')
      // {
      //     $user->lastname = $request->get('lastname');
      // }
      //
      // if($request->get('password') != '')
      // {
      //   $user->password = bcrypt($request->get('password'));
      // }
      //
      // if($request->get('username') != '')
      // {
      //     $user->username = $request->get('username');
      // }
      //
      // if($request->get('email') != '')
      // {
      //     $user->email = $request->get('email');
      // }
      //
      // $user->save();
      //
      // return redirect(action('AdminController@editAdmin', $user->id))->with('status', 'Admin updated successfully.');
    }

    public function updateDefaultWishlist(DefaultWishlistRequest $request, $id)
    {
      if (Auth::user()->type == 0) {
        $defaultwishlist = DefaultWishlist::where('id', $id)->first();

        if($request->get('title') != '')
        {
            $defaultwishlist->title = $request->get('title');
        }

        $defaultwishlist->save();

        return redirect(action('AdminController@editDefaultWishlist', $defaultwishlist->id))->with('status', 'Default wishlist updated successfully.');
      }
      else
        return redirect('user/home');

      // $defaultwishlist = DefaultWishlist::where('id', $id)->first();
      //
      // if($request->get('title') != '')
      // {
      //     $defaultwishlist->title = $request->get('title');
      // }
      //
      // $defaultwishlist->save();
      //
      // return redirect(action('AdminController@editDefaultWishlist', $defaultwishlist->id))->with('status', 'Default wishlist updated successfully.');
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

    public function deleteDefaultWishlist($id)
    {
        $dw = DefaultWishlist::where('id', $id)->firstorFail();

        $dw->status = 0;

        $dw->save();

        $defaultwishlists = DefaultWishlist::where('status', '=', 1)
                                            ->orderBy('created_at', 'desc')
                                            ->get();

        return view('admin.viewDefaultWishlists', compact('defaultwishlists'))->with('status', 'Default wishlist deleted successfully.');

    }

    public function deactivateUser($id)
    {
        $user = User::where('id', $id)->firstorFail();

        $user->status = 0;

        $user->save();

        $users = User::where('status', '=', 1)
                      ->where('type', '=', 1)
                      ->orderBy('created_at', 'desc')
                      ->get();

        // print($id);
        return view('admin.monitoringUsers', compact('users'))->with('status', 'User has been deactivated successfully.');

    }
}

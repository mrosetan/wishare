<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\UserRequest;
use App\Http\Requests\EditAdminRequest;
use App\Http\Requests\DefaultWishlistRequest;
use App\Http\Requests\AdminSearchRequest;
use App\User;
use App\Wish;
use App\DefaultWishlist;
use App\Wishlist;
use Auth;
use Validator;

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
        return redirect('admin/stats');
      }
      else{
        return redirect('user/home');
      }

    }

    public function stats()
    {
      if (Auth::user()->type == 0) {

        $userCount = User::where('type', 1)
                          ->count();

        $userActiveCount = User::where('status', 1)
                                ->where('type', 1)
                                ->count();

        $userInactiveCount = User::where('status', 0)
                                  ->where('type', 1)
                                  ->count();

        $adminActiveCount = User::where('status', 1)
                                ->where('type', 0)
                                ->count();

        $adminInactiveCount = User::where('status', 0)
                                  ->where('type', 0)
                                  ->count();

        $wishesCount = Wish::count();

        $wishDelCount = Wish::where('status', 0)
                        ->count();

        $wishGrantedCount = Wish::where('granted', 1)
                                  ->count();

        $granters = Wish::where('granted', 1)
                          ->distinct('granterid')
                          ->count('granterid');



        // print($granters);
        // die();

        return view('admin.stats', compact('userCount', 'userActiveCount', 'userInactiveCount', 'adminActiveCount', 'adminInactiveCount', 'wishesCount', 'wishDelCount', 'wishGrantedCount', 'granters'));
      }
      else
        return redirect('user/home');
    }

    public function report(){
      if (Auth::user()->type == 0) {

        $userCount = User::where('type', 1)
                          ->count();

        $userActiveCount = User::where('status', 1)
                                ->where('type', 1)
                                ->count();

        $userInactiveCount = User::where('status', 0)
                                  ->where('type', 1)
                                  ->count();

        $adminActiveCount = User::where('status', 1)
                                ->where('type', 0)
                                ->count();

        $adminInactiveCount = User::where('status', 0)
                                  ->where('type', 0)
                                  ->count();

        $wishesCount = Wish::count();

        $wishDelCount = Wish::where('status', 0)
                        ->count();

        $wishGrantedCount = Wish::where('granted', 1)
                                  ->count();

        $granters = Wish::where('granted', 1)
                          ->distinct('granterid')
                          ->count('granterid');



        // print($granters);
        // die();

        return view('admin.report', compact('userCount', 'userActiveCount', 'userInactiveCount', 'adminActiveCount', 'adminInactiveCount', 'wishesCount', 'wishDelCount', 'wishGrantedCount', 'granters'));

      }
      else
        return redirect('user/home');
    }

    // ===================================Search ver 1=====
    // public function search()
    // {
    //   if (Auth::user()->type == 0) {
    //     $results = '';
    //     return view('admin.search', compact('results'));
    //   }
    //   else
    //     return redirect('user/home');
    // }
    //
    // public function searchUser(AdminSearchRequest $request)
    // {
    //
    //   if (Auth::user()->type == 0) {
    //     $search = $request->search;
    //
    //     $results = User::where('firstname', 'like', '%'.$search.'%')
    //                     ->orWhere('lastname', 'like', '%'.$search.'%')
    //                     ->orWhere('username', 'like', '%'.$search.'%')
    //                     ->orWhere('email', 'like', '%'.$search.'%')
    //                     ->orderBy('status', 'desc')
    //                     ->get();
    //
    //     if(count($results) > 0)
    //       return view('admin.search', compact('results'));
    //     else
    //       return view('admin.search')->with('errormsg', 'Not found');
    //
    //   }
    //   else
    //     return redirect('user/home');
    // }
    // ===================================Search ver 1=====

    public function search(Request $request)
    {
      $user = Auth::user();
      $search = $request->search;

      $results = User::where(function ($query) use ($search){
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
        return view('admin.search2', compact('results'));
      // else{
        // return view('userlayouts.searchFriend')->with('errormsg', 'Not found');
      // }
    }

    public function searchUserOrAdmin()
    {
      if (Auth::user()->type == 0) {
        $results = User::paginate();

        return view('admin.search', compact('results'));
      }
      else
        return redirect('user/home');
    }

    public function monitorUsers()
    {

      if (Auth::user()->type == 0) {
        // $users = User::where('status', '=', 1)
        //               ->where('type', '=', 1)
        //               ->orderBy('created_at', 'desc')
        //               // ->get();
        //               ->paginate();

        $users = User::paginate();

        // $users->setPath('http://192.168.1.10/wishare/public/admin/monitor/users');
        // dd($users);
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

        $wishes = Wish::with('user', 'wishlist')->get();
        // dd($wishes);
        return view('admin.monitoringWishes', compact('wishes'));
      }
      else
        return redirect('user/home');

    }

    public function monitorWishlists()
    {
      if (Auth::user()->type == 0) {

        $wishlists = Wishlist::with('user')
                              // ->get();
                              ->paginate();

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
                                            // ->get();
                                            ->paginate();
        // $defaultwishlists->setPath('http://192.168.1.10/wishare/public/admin/view/defaultwishlists');

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
                      // ->get();
                      ->paginate();

        // $users->setPath('http://192.168.1.10/wishare/public/admin/view/admins');
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
     public function updateAdmin(Request $request, $id)
     {

       if (Auth::user()->type == 0) {
         $user = User::where('id', $id)->first();
         $details = array();
          // dd($request->get('password'));
         if($request->get('firstname') != '')
         {
             $details['firstname'] = $request->get('firstname');
         }

         if($request->get('lastname') != '')
         {
             $details['lastname'] = $request->get('lastname');
         }

         if($request->get('password') != '')
         {
           $details['password'] = bcrypt($request->get('password'));
         }

         if($request->get('username') != '' and $request->get('username') != $user->username)
         {
             $details['username'] = $request->get('username');
         }

         if($request->get('email') != '' and $request->get('email') != $user->email)
         {
             $details['email'] = $request->get('email');
         }


         $messages = [
             'firstname.required' => 'First name is required.',
             'firstname.min' => 'First name must be at least 3 characters.',
             'firstname.max' => 'First name may not be greater than 50 characters.',
             'firstname.regex' => 'First name may only contain letters.',

             'lastname.required' => 'Last name is required.',
             'lastname.min' => 'Last name must be at least 2 characters.',
             'lastname.max' => 'Last name may not be greater than 50 characters.',
             'lastname.regex' => 'Last name may only contain letters.',

             'username.required' => 'Username is required.',
             'username.min' => 'Username must be at least 3 characters.',
             'username.max' => 'Username may not be greater than 15 characters.',
             'username.alpha_num' => 'Username may only contain letters and numbers.',
             'username.unique' => 'Username has already been taken.',

             'password.required' => 'Password is required.',
             'password.min' => 'Password must be at least 3 characters.',
             'password.max' => 'Password may not be greater than 30 characters.',
             'password.alpha_num' => 'Password may only contain letters and numbers.',

             'email.required' => 'Email is required.',
             'email.email' => 'Email must be a valid email address.',
             'email.unique' => 'Email has already been taken.',
         ];

         $validator = Validator::make($details, [
           'lastname' => 'required|min:2|max:50|regex:/^[\pL\s]+$/u',
           'firstname' => 'required|min:3|max:50|regex:/^[\pL\s]+$/u',
           'username' => 'sometimes|required|min:3|max:15|alpha_num|unique:wishare_users',
           'password' => 'sometimes|required|min:3|max:30|alpha_num',
           'email' => 'sometimes|required|email|unique:wishare_users',
           ], $messages);

           if ($validator->fails()) {
               return redirect(action('AdminController@editAdmin', $user->id))
                           ->withErrors($validator);
                           // ->withInput();
           }
           else{
             // $user->save();
             $updateUser = User::where('id','=',$user->id)->update($details);

             //return redirect(action('userController@editSettings', $user->id))->with('status', 'Saved.');
             return redirect(action('AdminController@editAdmin', $user->id))->with('status', 'Admin updated successfully.');
           }



       }
       else
         return redirect('user/home');
     }



    // public function updateAdmin(EditAdminRequest $request, $id)
    // {
    //
    //   if (Auth::user()->type == 0) {
    //     $user = User::where('id', $id)->first();
    //
    //     if($request->get('firstname') != '')
    //     {
    //         $user->firstname = $request->get('firstname');
    //     }
    //
    //     if($request->get('lastname') != '')
    //     {
    //         $user->lastname = $request->get('lastname');
    //     }
    //
    //     if($request->get('password') != '')
    //     {
    //       $user->password = bcrypt($request->get('password'));
    //     }
    //
    //     if($request->get('username') != '')
    //     {
    //         $user->username = $request->get('username');
    //     }
    //
    //     if($request->get('email') != '')
    //     {
    //         $user->email = $request->get('email');
    //     }
    //
    //     $user->save();
    //
    //     return redirect(action('AdminController@editAdmin', $user->id))->with('status', 'Admin updated successfully.');
    //   }
    //   else
    //     return redirect('user/home');
    // }

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
                      // ->get();
                      ->paginate();

        return view('admin.viewAdmins', compact('users'));

    }

    public function deleteDefaultWishlist($id)
    {
        $dw = DefaultWishlist::where('id', $id)->firstorFail();

        $dw->status = 0;

        $dw->save();

        $defaultwishlists = DefaultWishlist::where('status', '=', 1)
                                            ->orderBy('created_at', 'desc')
                                            // ->get();
                                            ->paginate();

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
                      // ->get();
                      ->paginate();

        return view('admin.monitoringUsers', compact('users'))->with('status', 'User has been deactivated successfully.');

    }

    // ================================Search User/Admin Actions =====================================

    public function reactivate($id)
    {
        $user = User::where('id', $id)->firstorFail();

        $user->status = 1;

        $user->save();

        $results = User::paginate();

        return redirect(action('AdminController@userdetails', $user->id));
        // return view('admin.search', compact('results'));

    }

    public function deactivate($id)
    {
        $user = User::where('id', $id)->firstorFail();

        $user->status = 0;

        $user->save();

        $results = User::paginate();

        return redirect(action('AdminController@userdetails', $user->id));
        // return view('admin.search', compact('results'));

    }

    public function userdetails($id)
    {
      $user = User::where('id', $id)->firstorFail();

      return view('admin.userdetails', compact('user'));
    }
}

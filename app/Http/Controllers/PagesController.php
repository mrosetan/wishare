<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class PagesController extends Controller
{

  public function index()
  {
      if(Auth::check()){
        if(Auth::user()->type == '0')
        {
            return view('admin.master');
        }
        else
        {
            return redirect('user/home');
        }
      }
      else
        return view('pages.landingpage');
  }

  public function signin()
  {
    if(Auth::check()){
      if(Auth::user()->type == '0')
      {
          return view('admin.master');
      }
      else
      {
          return redirect('user/home');
      }
    }
    else
      return view('pages.signin');
  }

  public function signup()
  {
    if(Auth::check()){
      if(Auth::user()->type == '0')
      {
          return view('admin.master');
      }
      else
      {
          return redirect('user/home');
      }
    }
    else
      return view('pages.registration');
  }

  public function blank()
  {
      return view('pages.blank');
  }
}

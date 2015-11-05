<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{

  public function index()
  {
      return view('pages.landingpage');
  }

  public function signin()
  {
      return view('pages.signin');
  }

  public function signup()
  {
      return view('pages.registration');
  }

  public function blank()
  {
      return view('pages.blank');
  }
}

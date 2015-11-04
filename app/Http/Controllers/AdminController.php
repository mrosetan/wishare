<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('admin.master');
    }

    public function reports()
    {
      return view('admin.reports');
    }

    public function monitorUsers()
    {
      return view('admin.monitoringUsers');
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
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

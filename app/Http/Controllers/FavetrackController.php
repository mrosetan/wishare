<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\FavoriteTrack;
use Input;
use Auth;

class FavetrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function favorite()
    {
      $wishid = Input::get('id');

      $user = Auth::user();

      $fave = new FavoriteTrack(array(
        'wishid' => $wishid,
        'userid' => $user['id'],
        'type' => 2,
      ));

      $fave->save();

      $faves = FavoriteTrack::where('wishid', '=', $wishid)
                              ->where('type', '=', 2)
                              ->count();
      // dd($faves);                
      $status = 'ok';
      return json_encode($faves);
      // echo json_encode($data);
    }

    public function unfavorite()
    {
      $wishid = Input::get('id');

      $user = Auth::user();

      $fave = FavoriteTrack::where('wishid', $wishid)
                            ->where('userid', $user['id'])
                            ->where('type', 2)
                            ->first();

      if (!empty($fave)) {
        $fave->delete();
      }

      $faves = FavoriteTrack::where('wishid', '=', $wishid)
                              ->where('type', '=', 2)
                              ->count();

      $status = 'ok';
      return json_encode($faves);
      // echo json_encode($data);
    }

    public function trackwish()
    {
      $wishid = Input::get('id');

      $user = Auth::user();

      $fave = new FavoriteTrack(array(
        'wishid' => $wishid,
        'userid' => $user['id'],
        'type' => 1,
      ));

      $fave->save();

      $tracks = FavoriteTrack::where('wishid', '=', $wishid)
                              ->where('type', '=', 1)
                              ->count();

      $status = 'ok';
      return json_encode($tracks);
      // echo json_encode($data);
    }

    public function untrackwish()
    {
      $wishid = Input::get('id');

      $user = Auth::user();

      $fave = FavoriteTrack::where('wishid', $wishid)
                            ->where('userid', $user['id'])
                            ->where('type', 1)
                            ->first();

      if (!empty($fave)) {
        $fave->delete();
      }

      $tracks = FavoriteTrack::where('wishid', '=', $wishid)
                              ->where('type', '=', 1)
                              ->count();

      $status = 'ok';
      return json_encode($tracks);
      // echo json_encode($data);
    }

}

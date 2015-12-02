<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Wish extends Model
{
  protected $table = 'wishes';

  protected $fillable = ['wishlistid', 'title', 'createdby_id', 'details', 'wishimageurl', 'alternatives', 'due_date', 'granted', 'grantedid', 'granteddetails', 'granteddetails', 'grantedimageurl', 'date_granted', 'flagged', 'status'];

  public function wishlist()
  {
    return $this->belongsTo('App\Wishlist', 'wishlistid', 'id');
  }

  public function user()
  {
    return $this->belongsTo('App\User', 'createdby_id', 'id');
  }

  public function tags()
  {
    // return $this->hasManyThrough('App\Tag', 'App\User', 'id', 'userid');
    return $this->hasMany('App\Tag', 'wishid', 'id');
  }

  public function stream($friendsId){
    $stream = DB::table('wishes')
              ->whereIn('createdby_id', $friendsId)
              ->get();

              print_r($stream); die();

    return $stream;
  }
}

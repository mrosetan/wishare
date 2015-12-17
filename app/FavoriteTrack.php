<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavoriteTrack extends Model
{
  protected $table = 'favorite_bookmark';

  protected $fillable = ['wishid', 'userid', 'type'];

  public function wish(){
    return $this->hasOne('App\Wish', 'id', 'wishid');
    // return $this->hasOne('App\Wish', 'id', 'wishid')->where('createdby_id', 2);
  }

  public function user(){
    return $this->hasOne('App\User', 'id', 'userid');
  }
}

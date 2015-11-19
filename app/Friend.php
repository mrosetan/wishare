<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
  protected $table = 'friends';

  protected $fillable = ['friend_userid', 'userid', 'date_added', 'date_accepted', 'status', 'seen'];

  public function  addedFriends ()
  {
      return $this->belongsTo('App\User', 'userid');
      // return $this->belongsTo('App\User', 'userid');
  }

  public function userFriends()
  {
      return $this->belongsTo('App\User', 'friend_userid');
      // return $this->belongsTo('App\User', 'userid');
  }

  public function user()
  {
    return $this->belongsTo('App\User', 'userid');
  }
}

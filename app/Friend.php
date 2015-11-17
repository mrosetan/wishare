<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
  protected $table = 'friends';

  protected $fillable = ['friend_userid', 'userid', 'date_added', 'date_accepted', 'status'];

  public function user()
  {
      return $this->belongsTo('App\User', 'userid');
  }
}

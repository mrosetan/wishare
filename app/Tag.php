<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
  protected $table = 'tags';

  protected $fillable = ['wishid', 'userid', 'datetagged'];

  public function wish()
  {
    return $this->belongsTo('App\Wish', 'wishid', 'id');
  }

  public function user()
  {
      return $this->belongsTo('App\User', 'userid', 'id');
  }
}

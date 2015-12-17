<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavoriteTrack extends Model
{
  protected $table = 'favorite_bookmark';

  protected $fillable = ['wishid', 'userid', 'type'];
}

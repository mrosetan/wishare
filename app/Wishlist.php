<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlists';

    protected $fillable = ['createdby_id', 'title', 'privacy', 'created_at', 'status'];

    public function user()
    {
      return $this->belongsTo('App\User', 'createdby_id', 'id');
    }
}

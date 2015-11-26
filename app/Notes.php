<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    protected $table = 'notes';

    protected $fillable = ['senderid', 'receiverid', 'message', 'type', 'sticker', 'imageurl', 'date_created', 'status', 'created_at'];

    public function user()
    {
      return $this->belongsTo('App\User', 'receiverid', 'id', 'senderid', 'id');
    }
}

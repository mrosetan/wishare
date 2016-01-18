<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Wish extends Model
{
  protected $table = 'wishes';

  protected $fillable = ['wishlistid', 'title', 'createdby_id', 'details', 'wishimageurl', 'alternatives', 'due_date', 'granted', 'granterid', 'granteddetails', 'granteddetails', 'grantedimageurl', 'date_granted', 'flagged', 'status'];

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
    // $stream = DB::table('wishes')
    //           ->where('status', '=', 1)
    //           ->whereIn('createdby_id', $friendsId)
    //           ->get();

    $stream = DB::table('wishes')
                     ->leftJoin('wishare_users AS wisher','wisher.id','=','wishes.createdby_id')
                     ->leftJoin('wishare_users AS granter','granter.id','=','wishes.granterid')
                     ->leftJoin('wishlists','wishlists.id','=','wishes.wishlistid')
                     ->select('wisher.id AS userid', 'wisher.firstname', 'wisher.lastname', 'wisher.username','wisher.imageurl',
                              'wishes.id AS wishid', 'wishes.created_at', 'wishes.updated_at', 'wishes.wishlistid', 'wishes.title', 'wishes.flagged', 'wishes.details',
                              'wishes.wishimageurl','wishes.alternatives','wishes.due_date','wishes.granted', 'wishes.date_granted',
                              'wishes.granterid','wishes.granteddetails','wishes.grantedimageurl', DB::raw('IFNULL(granter.firstname, "") AS granterfirstname'), DB::raw('IFNULL(granter.lastname, "") AS granterlastname'), DB::raw('IFNULL(granter.username, "") AS granterusername'),
                              DB::raw('IFNULL(granter.imageurl, "") AS granterimageurl'))
                     ->where('wishes.status','=','1')
                     ->where('wishlists.privacy','=','0')
                     ->where('wishlists.status','=','1')
                     ->whereIn('wishes.createdby_id',$friendsId)
                     ->orderBy('wishes.updated_at','desc')
                    //  ->paginate();
                     ->get();
                    // dd($stream);
    return $stream;
  }

  public function granter(){
    return $this->hasOne('App\User', 'id', 'granterid');
  }

  public function trackfave(){
    return $this->hasMany('App\FavoriteTrack', 'wishid', 'id', 'type');
  }
}

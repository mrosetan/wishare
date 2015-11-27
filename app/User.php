<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'wishare_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fb_id', 'lastname', 'firstname', 'username', 'password', 'email', 'privacy', 'type', 'status', 'defaultwishlist', 'imageurl', 'city', 'birthdate', 'facebook', 'forgot_password_token'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = ['password'];
    protected $hidden = ['password', 'remember_token'];

    public function wishlists()
    {
        return $this->hasMany('App\Wishlist', 'id');
    }

    public function wishes()
    {
        return $this->hasMany('App\Wish', 'id');
    }

    public function tags()
    {
        return $this->hasMany('App\Tag', 'userid');
    }

    function friendsOfMine()
    {
      return $this->belongsToMany('App\User', 'friends', 'userid', 'friend_userid')
        // if you want to rely on accepted field, then add this:
        ->wherePivot('status', '=', 1)
        ->withPivot('status')
        ->withPivot('id');
    }

    function friendOf()
    {
      return $this->belongsToMany('App\User', 'friends', 'friend_userid', 'userid')
         ->wherePivot('status', '=', 1)
         ->withPivot('status')
         ->withPivot('id');
    }

    public function getFriendsAttribute()
    {
        if ( ! array_key_exists('friends', $this->relations)) $this->loadFriends();

        return $this->getRelation('friends');
    }

    protected function loadFriends()
    {
        if ( ! array_key_exists('friends', $this->relations))
        {
            $friends = $this->mergeFriends();

            $this->setRelation('friends', $friends);
        }
    }

    protected function mergeFriends()
    {
        return $this->friendsOfMine->merge($this->friendOf);
    }
}

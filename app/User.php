<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	public function wishlist(){
		return $this->hasOne('App\Wishlist');
	}
	
	// this is a recommended way to declare event handlers
	protected static function boot() {
		parent::boot();
		static::deleting(function($user) { // before delete() method call this
			$user->wishlist()->delete();
		// do the rest of the cleanup...
		});
	}
}

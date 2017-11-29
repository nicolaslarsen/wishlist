<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
	// Table name
	protected $table = 'wishlists';

	// primary key
	public $primaryKey = 'id';

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function items(){
		return $this->hasMany('App\Item');
	}
	
	// this is a recommended way to declare event handlers
	protected static function boot() {
		parent::boot();
		static::deleting(function($wishlist) { // before delete() method call this
			$wishlist->items()->delete();
		// do the rest of the cleanup...
		});
	}
}

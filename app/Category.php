<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'categories';

	public $primaryKey = 'id';

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function items(){
		return $this->hasMany('App\Item');
	}
}

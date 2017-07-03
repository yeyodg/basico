<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class User1 extends Model implements Authenticatable
{
	use \Illuminate\Auth\Authenticatable;
	public function posts()
	{
		return $this->hasMany('App\Post');
	}
	public function likes()
	{
		return $this->hasMany('App\Like');
	}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user1()
    {
    	return $this->belongsTo('App\User1');
    }
}

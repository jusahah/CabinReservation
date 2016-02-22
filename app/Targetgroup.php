<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Targetgroup extends Model
{
    //

    public function admin() {
    	// We must fetch manually because relationship 
    	// could not be defined thanks to circular stuff etc
    	return User::findOrFail($this->user_id);
    }

    public function targets() {
    	return $this->hasMany('App\Target');
    }

    public function members() {
    	return $this->hasMany('App\User');
    }


}

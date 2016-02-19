<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    //

    public function reservations() {
    	return $this->hasMany('App\Reservation');
    }

    public function targetgroup() {
    	return $this->belongsTo('App\Targetgroup');
    }

}

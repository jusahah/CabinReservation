<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendinggroupjoinrequest extends Model
{
    //

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function targetgroup() {
    	return $this->belongsTo('App\Targetgroup');
    }


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //

	public function target() {
		return $this->belongsTo('App\Target');
	}

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function originalUser() {
		return $this->belongsTo('App\User', 'original_user_id');
	}

}

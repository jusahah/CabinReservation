<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
    	'user_id', 
    	'original_user_id', 
    	'target_id',
    	'startdate', 
    	'enddate', 
    	'notes',
    ];

    public static $rules = array(
    	//'user_id' => 'required|integer', 
    	//'original_user_id' => 'required|integer', 
    	'startdate' => 'required|date', 
    	'enddate' => 'required|date', 
    	'notes' => 'string|max:512',
    );

    public static function validationRules() {
    	return self::$rules;
    }

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

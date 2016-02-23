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

    public static $suomirules = array(
    	//'user_id' => 'required|integer', 
    	//'original_user_id' => 'required|integer', 
    	'startdate' => 'required|date_format:d.m.Y', 
    	'enddate' => 'required|date_format:d.m.Y', 
    	'notes' => 'string|max:512',
    );


    public static function validationRules() {
    	return self::$rules;
    }

    public static function suomiValidationRules() {
    	return self::$suomirules;
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

	public function getNotesTrimmed($len) {
		$notes = $this->notes;

		if (strlen($notes) <= $len-3) {
			return $notes;
		}

		return substr($notes, 0, $len-3) . "...";
	}

	public function getDurationInDays() {
		$date1 = new \DateTime($this->startdate);
		$date2 = new \DateTime($this->enddate);

		$diff = $date2->diff($date1)->format("%a");

		return $diff+1;
	}

}

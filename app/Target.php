<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Target extends Model
{
    //

    protected $fillable = [
    	'name', 
    	'description', 
    	'targetgroup_id',
    	'maxReservationLength', 
    	'minReservationLength', 
    	'emailWhenSomebodyReserves',
    	'emailWhenSomebodyCancels',
    	'emailWhenGeneralAnnouncement',
    	'allowTwoReservationsBySameUser'
    ];

    public static $rules = array(
    	'name' => 'required|string|min:1|max:64',
    	'description' => 'required|min:1|max:512',
    	'maxReservationLength' => 'integer|max:365',
    	'minReservationLength' => 'integer|max:365',
    	'emailWhenSomebodyReserves' => 'integer|min:0|max:2',
    	'emailWhenSomebodyCancels' => 'integer|min:0|max:2',
    	'emailWhenGeneralAnnouncement' => 'integer|min:0|max:2',
    	'allowTwoReservationsBySameUser' => 'integer|min:0|max:1',
    );

    public static function validationRules() {
    	return self::$rules;
    }

    public function reservations() {
    	return $this->hasMany('App\Reservation');
    }

    public function targetgroup() {
    	return $this->belongsTo('App\Targetgroup');
    }

    public function isFreeNow() {

    	$today = date('Y-m-d');
    	$comingreservations = $this->reservations()->where('enddate', '>=', $today)->get();

    	//dd($comingreservations);

    	foreach ($comingreservations as $key => $reservation) {

    		if ($reservation->startdate <= $today && $reservation->enddate >= $today) {
    			return false;
    		}
    	}

    	return true;
    }

    public function getNextReservation() {
    	$today = date('Y-m-d');
    	$comingreservations = $this->reservations()->where('startdate', '>', $today)->get();

    	if (count($comingreservations) == 0) return null;

    	$sorted = $comingreservations->sortBy('startdate');
    	return $sorted[0];

    }

}

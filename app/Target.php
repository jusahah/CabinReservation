<?php

namespace App;

use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use Illuminate\Database\Eloquent\Model;
use Validator;

use App\User;

class Target extends Model
{
    //
    protected $today;

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

    public function __construct() {
        $this->today = date('Y-m-d');
    }

    public static function validationRules() {
    	return self::$rules;
    }

    public function reservations() {
    	return $this->hasMany('App\Reservation');
    }

    public function targetgroup() {
    	return $this->belongsTo('App\Targetgroup');
    }

    public function infomessages() {
        return $this->hasMany('App\Announcement');
    }

    public function isFreeNow() {
    	$comingreservations = $this->reservations()->where('enddate', '>=', $this->today)->get();

    	//dd($comingreservations);

    	foreach ($comingreservations as $key => $reservation) {

    		if ($reservation->startdate <= $this->today && $reservation->enddate >= $this->today) {
    			return false;
    		}
    	}

    	return true;
    }

    public function getNextReservation() {
    	$comingreservations = $this->reservations()->where('startdate', '>', $this->today)->get();

    	if (count($comingreservations) == 0) return null;

    	$sorted = $comingreservations->sortBy('startdate');
    	return $sorted[0];

    }

    public function latestInfoMessage() {

        return [];

    }

    public function numOfReservations() {
        return count($this->reservations()->get());
    }

    public function numOfReservationsPending() {
        return count($this->reservations()->where('startdate', '>', $this->today)->get());
    }

    // These two could be collapsed into more suitable DRY but lets keep it dirty for now
    public function infoMostActiveReserverInDays() {
        $reservations = $this->reservations()->get();
        $userIDsToDayCounts = [];

        foreach ($reservations as $key => $reservation) {
            $days = $reservation->getDurationInDays();
            if (!array_key_exists($reservation->user_id, $userIDsToDayCounts)) {
                $userIDsToDayCounts[$reservation->user_id] = 0;
            }

            $userIDsToDayCounts[$reservation->user_id] += $days;
        }
        if (count($userIDsToDayCounts) == 0) return '(Ei varaajia)';
        asort($userIDsToDayCounts);

        $userIDs = array_keys($userIDsToDayCounts);

        

        $uid = $userIDs[0];
        try {
            $user = User::findOrFail($uid);
        } catch (ModelNotFoundException $e) {
            return '---';

        }

        return $user->name . " (" . $userIDsToDayCounts[$uid] . " päivää)";
        
    }

    public function infoMostActiveReserverInCount() {
        $reservations = $this->reservations()->get();
        $userIDsToCounts = [];

        foreach ($reservations as $key => $reservation) {  
            if (!array_key_exists($reservation->user_id, $userIDsToCounts)) {
                $userIDsToCounts[$reservation->user_id] = 0;
            }

            $userIDsToCounts[$reservation->user_id] += 1;            
        }  

        if (count($userIDsToCounts) == 0) return '(Ei varaajia)';

        asort($userIDsToCounts);
        $userIDs = array_keys($userIDsToCounts);
    
        $uid = $userIDs[0];
        try {
            $user = User::findOrFail($uid);
        } catch (ModelNotFoundException $e) {
            return '---';

        }

        return $user->name . " (" . $userIDsToCounts[$uid] . " kpl)";

    }

}

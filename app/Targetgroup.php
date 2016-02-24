<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Targetgroup extends Model
{
    //

    protected $fillable = ['name', 'description', 'allowTwoReservationsInsideGroupBySameUser']; 

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
    // Return value to be used in join requests and etc.
    public function getURIName() {

        // As two groups can have same name we need to attach ID 
        $toBeSlugified = $this->name . " " . $this->id;
        return str_slug($toBeSlugified, "-");

    }

    public function autoJoin() {
        return false; // For now
    }

}

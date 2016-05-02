<?php

namespace App\Http\Controllers;

use App\Target;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Targetgroup;
use App\User;


class GuestController extends Controller
{
    public function __construct(Request $r) {
        parent::__construct($r, false);
    } 

    public function showAdminCreation(Request $request) {

    	return view('guest/adminform');
    	

    }

    public function createGroup(Request $request) {
    	$input = $request->all();

    	$validator = $this->validator($input);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        \DB::transaction(function() use ($input) {

        	// Create fresh group
	        $group = Targetgroup::create([
	        	'name' => $input['ryhmanimi'],
	        	'description' => $input['ryhmakuvaus'],
	        	'allowTwoReservationsInsideGroupBySameUser' => 0
	        ]);

	        // Create corresponding admin user linked to that group
	        $user = User::create([
	            'name' => $input['name'],
	            'email' => $input['email'],
	            'password' => bcrypt($input['password']),
	            'targetgroup_id' => $group->id,
	            'isActivated' => 1,
	            'emailNotificationsOn' => 1,
	            'isActivated' => 1
	        ]);

	        // Link group to user by updating its user_id field
	        $group->user_id = $user->id;
	        $group->save();
        });
        $request->session()->flash('operationsuccess', 'Uusi ryhmä ja admin-käyttäjä luotu! Voit nyt kirjautua sisään juuri luomallasi käyttäjätunnuksella.');
        return redirect('auth/login');


    }

    protected function getAllReservationsInGroup($group) {

        $targets = $group->targets;

        $reservations = [];

        foreach ($targets as $key => $target) {
            $reservations = array_merge($reservations, $target->reservations->all());
        }

        $reservations = collect($reservations);

        return $reservations;
    }

    public function guestViewOfTarget(Request $request, $ryhmaURINimi, $kohdeURINimi) {

        $group = $this->findGroupByURI($ryhmaURINimi);
        
        $targets = $group->targets()->get();
        $correctTarget = null;
        foreach($targets as $k => $target) {
            if ($target->getURIName() == $kohdeURINimi) {
                $correctTarget = $target;
            }
        }

        if (!$correctTarget) return response('Kohdetta ei löytynyt [Virhe: 001]', 404);

        return view('guest/targetcalendar')->with('group', $group)->with('target', $correctTarget)->with('reservations', $target->reservations);

    }

    public function guestViewOfGroup(Request $request, $ryhmaURINimi) {
        $group = $this->findGroupByURI($ryhmaURINimi);
        $reservations = $this->getAllReservationsInGroup($group);

        return view('guest/groupcalendar')->with('group', $group)->with('reservations', $reservations);

    }

    protected function findGroupByURI($ryhmaURINimi) {
         $groups = Targetgroup::select('id', 'name')->get();

         foreach ($groups as $key => $group) {
             if ($ryhmaURINimi == $group->getURIName()) {
                return Targetgroup::findOrFail($group->id);
             }
         }

         throw new ModelNotFoundException();
    }    
    protected function findTargetIDByURI($ryhmaURINimi) {
         $groups = Targetgroup::select('id', 'name')->get();

         foreach ($groups as $key => $group) {
             if ($ryhmaURINimi == $group->getURIName()) {
                $group2 = Targetgroup::findOrFail($group->id);
                return $group2;
             }
         }

         throw new ModelNotFoundException();
    } 

    protected function validator(array $data)
    {
    	// Validation for new admin user input data
        return \Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:4',
            'ryhmanimi' => 'required|string|min:1|max:64',
            'ryhmakuvaus' => 'string|max:512'
        ]);
    }    

}

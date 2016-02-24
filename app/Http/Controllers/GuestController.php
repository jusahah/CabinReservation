<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GuestController extends Controller
{
    public function __construct(Request $r) {
        parent::__construct($r, false);
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

        if (!$correctTarget) return response('Kohdetta ei löytynyt', 404);

        return view('guest/targetcalendar')->with('group', $group)->with('target', $correctTarget);

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
                return $group->id;
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
}

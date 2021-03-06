<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Targetgroup;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $r) {
        parent::__construct($r);
    }

    public function index()
    {
        //
    }
    // This method is duplicated here and in GuestController
    // Its of course good example why we'd better have that fucker Service Layer 
    protected function getAllReservationsInGroup($group) {

        $targets = $group->targets;

        $reservations = [];

        foreach ($targets as $key => $target) {
            $reservations = array_merge($reservations, $target->reservations->all());
        }

        $reservations = collect($reservations);

        return $reservations;
    }

    public function memberFront(Request $request, $ryhmaID) {

        $group = Targetgroup::with('targets')->with('targets.reservations')->findOrFail($ryhmaID);
        $reservations = $this->getAllReservationsInGroup($group);

        view()->share('currentpage', 'etusivu'); // This route is one of the sidebar menu links
        return view('member/ryhmaetusivu')->with('group', $group)->with('reservations', $reservations);
    }

    public function showNoGroupFront(Request $request) {
        // Check to make sure he has no group
        $tgid = \Auth::user()->targetgroup_id;
        if ($tgid) return redirect()->route('jasenetusivu', ['ryhmaID' => $tgid]);
        return view('member/nogroup');
    }

    /*
    protected function findGroupIDByURI($ryhmaURINimi) {
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
    */

}

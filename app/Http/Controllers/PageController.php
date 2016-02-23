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

    public function memberFront(Request $request, $ryhmaID) {

        $group = Targetgroup::with('targets')->with('targets.reservations')->findOrFail($ryhmaID);
        $targets = $group->targets;

        $reservations = [];

        foreach ($targets as $key => $target) {
            $reservations = array_merge($reservations, $target->reservations->all());
        }

        $reservations = collect($reservations);
        view()->share('currentpage', 'etusivu'); // This route is one of the sidebar menu links
        return view('member/ryhmaetusivu')->with('group', $group)->with('reservations', $reservations);
    }

    public function showNoGroupFront(Request $request) {
        return view('member/nogroup');
    }


}

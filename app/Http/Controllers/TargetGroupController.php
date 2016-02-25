<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Targetgroup;
use App\User;

class TargetGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $r) {
        parent::__construct($r);
    }

    public function index(Request $request)
    {
        $targetgroupID = $request->input('targetgroup_id');
        $group = Targetgroup::findOrFail($targetgroupID);
        $targets = $group->targets()->with('reservations')->get();

        view()->share('currentpage', 'kohdeluettelo'); // This route is one of the sidebar menu links

        return view('member/targets/all')
            ->with('targetgroup', $group)
            ->with('targets', $targets);
    }

        // GET route
    public function showTargetCreation(Request $request, $ryhmaID) {

        view()->share('currentpage', 'luokohde'); // This route is one of the sidebar menu links
        return view('member/createtarget');

    }

    public function showMembers(Request $request, $ryhmaID) {

        // Everytime we get this far we know user has a right to see group-level information
        $group = Targetgroup::findOrFail($ryhmaID);
        view()->share('currentpage', 'jasenet'); // This route is one of the sidebar menu links
        return view('member/groupmembers')->with('members', $group->members()->where('isActivated', 1)->get());
    }

    public function showLog(Request $request, $ryhmaID) {

        $group = Targetgroup::findOrFail($ryhmaID);
        $targets = $group->targets()->with('reservations')->with('reservations.user')->get();

        $reservations = [];

        foreach ($targets as $key => $target) {
            $reservations = array_merge($reservations, $target->reservations->all());

        }

        $reservations = collect($reservations);
        $reservations = $reservations->sortByDesc('startdate');

        view()->share('currentpage', 'loki'); // This route is one of the sidebar menu links
        return view('member/reservationlog')->with('reservations', $reservations);
    }
    // Shows a list of pending group join requests
    public function showApplications(Request $request, $ryhmaID) {

        $group = Targetgroup::findOrFail($ryhmaID);

        $applicants = $group->members()->where('isActivated', 0)->get();
        view()->share('currentpage', 'jasenhakemukset');

        return view('member/applications')->with('applicants', $applicants);

    }

    public function acceptApplication(Request $request, $ryhmaID, $jasenID) {

        $user = User::findOrFail($jasenID);

        if ($user->isActivated || $user->targetgroup_id != $ryhmaID) {
            $request->session()->flash('operationfail', 'Hakemusta ei voitu hyväksyä! [Virhe: 113]');
            return back();
        }
        // Perhaps inform user here?
        $user->isActivated = 1;
        $user->save();
        $request->session()->flash('operationsuccess', 'Hyväksyit käyttäjän ' . $user->name . ' hakemuksen!');
        return back();
    }


}

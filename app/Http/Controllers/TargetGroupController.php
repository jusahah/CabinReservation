<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Targetgroup;

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

        return view('member/targets/all')
            ->with('targetgroup', $group)
            ->with('targets', $targets);
    }

        // GET route
    public function showTargetCreation(Request $request) {

        return view('member/createtarget');

    }

    public function showMembers(Request $request) {
        return 'Target group member list';
    }

    public function showLog(Request $request) {
        return 'Target group log';
    }


}

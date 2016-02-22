<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Targetgroup;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(Request $request) {

    	$targetgroupID = $request->input('targetgroup_id');


    	try {
    		$group = Targetgroup::findOrFail($targetgroupID);
    		view()->share('targetgroupname', $group->name);
    		view()->share('groupmembercount', count($group->members()->get()));
    		view()->share('grouptargetcount', count($group->targets()->get()));
    	} catch (ModelNotFoundException $e) {
    		// Not foun
    		view()->share('targetgroupname', '(ei varausryhmää)');
    		view()->share('groupmembercount', '---');
    		view()->share('grouptargetcount', '---');
    	}

    	view()->share('global_ryhmaID', $targetgroupID);


    	
    }

}

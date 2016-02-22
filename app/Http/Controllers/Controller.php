<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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
    	} catch (Exception $e) {
    		// Not foun
    		view()->share('targetgroupname', '(ei varausryhmää)');
    	}
    	
    }

}

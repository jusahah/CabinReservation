<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

use App\Targetgroup;

class JoinGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Request $r) {
        parent::__construct($r, false);
    } 

    public function index()
    {
       
    }

    public function requestMembership(Request $request, $ryhmaURINimi) {

       try {
         $groupID = $this->findGroupIDByURI($ryhmaURINimi);
       } catch (ModelNotFoundException $e) {
         return view('auth/ryhmaaeiolemassa')->with('ryhmaURINimi', $ryhmaURINimi);    
       }

       $group = Targetgroup::findOrFail($groupID);

       return view('auth/register')->with('group', $group)->with('ryhmaURINimi', $ryhmaURINimi);
        


    }

    public function processMembershipApplication(Request $request, $ryhmaURINimi) {
        // POST request data must contain group id
        $input = $request->all();

        // Check uri and id point to same group
        $group = Targetgroup::findOrFail($input['groupID']);
        if ($group->getURIName() != $ryhmaURINimi) {
            return response('Unauthorized - URI name and groupID do not match', 403);
        }

        $validator = $this->validator($input);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($group->autoJoin()) {
            $isActivated = true;
        } else {
            $isActivated = false;
        }


        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
            'targetgroup_id' => $group->id,
            'emailNotificationsOn' => 1,
            'isActivated' => $isActivated
        ]);
        \Session::flash('operationsuccess', 'Tunnus luotu. Voit kirjautua sisään!');
        return redirect('auth/login');






    }

    protected function findGroupIDByURI($ryhmaURINimi) {
         $groups = Targetgroup::select('id', 'name')->get();

         foreach ($groups as $key => $group) {
             if ($ryhmaURINimi == $group->getURIName()) {
                return $group->id;
             }
         }

         throw new ModelNotFoundException();
    }

    protected function validator(array $data)
    {
        return \Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:4',
        ]);
    }    

}

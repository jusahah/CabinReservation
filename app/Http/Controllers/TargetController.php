<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Target;
use App\TargetGroup;

class TargetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // targetgroup_id was bound inside middleware
        $targetgroup_id = $request->input('targetgroup_id');

        $targets = Target::where('targetgroup_id', 3)->get();

        // If only one target, perhaps redirect straight to that targets reservation page

        return $targets;


    }

    public  function showTargetInfo(Request $request, $kohdeID) {
        $target = Target::findOrFail($kohdeID);
        return view('member/targetinfo')->with('target', $target)->with('me', \Auth::id());
    }
    // GET route
    public function showTargetCreation() {

        return view('member/createtarget');

    }

    // POST route
    public function createTarget(Request $request) {
        
        $validator = \Validator::make($request->all(), Target::validationRules());
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();            
        }
        
        $input = $request->all();
        $target = Target::create($input);

         // Success
        $request->session()->flash('operationsuccess', 'Uusi varauskohde luotu!');   
        return redirect('member/kohteet');

        // Default settings 

    }














    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

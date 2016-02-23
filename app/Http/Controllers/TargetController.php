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
    public function __construct(Request $r) {
        parent::__construct($r);
    }

    public function index(Request $request)
    {
        // targetgroup_id was bound inside middleware
        $targetgroup_id = $request->input('targetgroup_id');

        $targets = Target::where('targetgroup_id', 3)->get();

        // If only one target, perhaps redirect straight to that targets reservation page

        return $targets;


    }

    public function showTargetCalendar(Request $request, $ryhmaID, $kohdeID) {
        $target = Target::findOrFail($kohdeID);
        return view('member/targets/calendar')->with('target', $target);

    }

    public  function showTargetInfo(Request $request, $ryhmaID, $kohdeID) {
        $target = Target::findOrFail($kohdeID);
        $isAdmin = \Auth::id() == $target->targetgroup->user_id;
        return view('member/targets/info')->with('target', $target)->with('me', \Auth::id())->with('isAdmin', $isAdmin);
    }

    // POST route
    public function createTarget(Request $request, $ryhmaID) {
        
        $validator = \Validator::make($request->all(), Target::validationRules());
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();            
        }
        
        $input = $request->all();
        $target = Target::create($input);

         // Success
        $request->session()->flash('operationsuccess', 'Uusi varauskohde luotu!');   
        return redirect('member/' . $ryhmaID . '/kohteet');

        // Default settings 

    }

    public function askConfirmDeleteTarget(Request $request, $ryhmaID, $kohdeID) {
        $target = Target::findOrFail($kohdeID);
        return view('member/targets/deleteconfirmation')->with('target', $target);

    }

    public function deleteTarget(Request $request, $ryhmaID, $kohdeID) {
        $target = Target::findOrFail($kohdeID);
        $target->delete();
        $request->session()->flash('operationsuccess', 'Kohde on poistettu.');
        return redirect()->route('jasenetusivu', ['ryhmaID' => $ryhmaID]);
    }

    public function showEditTarget(Request $request, $ryhmaID, $kohdeID) {
        // Neat idea -> handle ALL ModenNotfoundExceptions in one place (app exception handler somewhere way above!)
        $target = Target::findOrFail($kohdeID);
        return view('member/targets/edit')->with('target', $target);
    }

    public function editTarget(Request $request, $ryhmaID, $kohdeID) {

        $validator = \Validator::make($request->all(), Target::validationRules());
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();            
        }
        $input = $request->all();
        $target = Target::findOrFail($kohdeID);
        $target->fill($input); // Mass assigment guard takes care of any alien extra params if present
        $target->save();
        \Session::flash('operationsuccess', 'Asetukset muutettu!');
        return back();

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

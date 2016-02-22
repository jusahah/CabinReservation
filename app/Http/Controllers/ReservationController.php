<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Target;
use App\Reservation;

class ReservationController extends Controller
{
    public function __construct(Request $r) {
        parent::__construct($r);
    }
    protected function checkReservationOverlap($kohdeID, $startDate, $endDate) {

        $reservations = Reservation::where('target_id', $kohdeID)->where('enddate', '>=', $startDate)->get();

        foreach ($reservations as $key => $reservation) {
            if ($endDate < $reservation->startdate || $startDate > $reservation->enddate) {
                true;
            } else {
                // Overlap!
                return false;
            }
        }

        return true;
    }

    public function showReservation(Request $request, $kohdeID, $varausID) {
        $reservation = Reservation::findOrFail($varausID);
        if ($reservation->target_id != $kohdeID) {
            return back()->with('operationfail', 'Varausta ei löytynyt kohteen ' . $kohdeID . ' alta.');
        }
        return view('member/reservation/single')->with('reservation', $reservation);
        return "Show reservation for: " . $kohdeID . " and " . $varausID;

    }



    public function targetReservations(Request $request, $kohdeID) {
        $target = Target::findOrFail($kohdeID);
        return $target->reservations()->get();
    }

    public function showReservationCreation(Request $request, $kohdeID) {
        $target = Target::findOrFail($kohdeID);
        return view('member/createreservation')->with('target', $target);
    }

    // POST route
    public function createReservation(Request $request, $kohdeID) {
        $validator = \Validator::make($request->all(), Reservation::validationRules());
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();            
        }
        // First checkpoint of validations passed
        // We still have to check that reservation does not overlap with other reservations
        // And check that user has no other reservations active if allowTwoReservationsBySameUser is set false
        $input = $request->all();

        $startDate = $input['startdate'];
        $endDate   = $input['enddate'];

        if (!$this->checkReservationOverlap($kohdeID, $startDate, $endDate)) {
            $request->session()->flash('operationfail', 'Varausta epäonnistui. Tarkista päivämäärät. Et voi varata päivälle, jolle on jo varaus olemassa.');
            return back()->withInput();

        }

        $input['user_id'] = \Auth::id();
        $input['original_user_id'] = \Auth::id();
        $input['target_id'] = $kohdeID;

        $reservation = Reservation::create($input);

         // Success
        $request->session()->flash('operationsuccess', 'Olet onnistuneesti tehnyt varauksen! <a>Tarkastele varaustasi tästä.</a>'); 
        return redirect('member/kohteet/' . $kohdeID . '/varaukset');

    }

    public function deleteReservation(Request $request, $kohdeID, $varausID) {
        // We want to ensure user owns this reservation
        $reservation = Reservation::findOrFail($varausID);
        
        if ($reservation->user_id != \Auth::id()) {
            return response('Unauthorized', 401);
        }

        if ($reservation->target_id != $kohdeID) {
            $request->session()->flash('operationfail', 'Varausta ei onnistuttu perumaan. Ota yhteys ylläpitäjään jos ongelma toistuu.');
            return back();
        }

        $reservation->delete();
        $request->session()->flash('operationsuccess', 'Varauksesi on peruttu onnistuneesti.');
        return redirect('member/kohteet/' . $kohdeID);

    }

    public function deleteReservationByAdmin(Request $request, $kohdeID, $varausID) {
        $reservation = Reservation::findOrFail($varausID);

        if ($reservation->target_id != $kohdeID) {
            $request->session()->flash('operationfail', 'Varausta ei onnistuttu poistamaan.');
            return back();
        }  

        $reservation->delete();
        $request->session()->flash('operationsuccess', 'Varauksesi on poistettu onnistuneesti.');
        return redirect('member/kohteet/' . $kohdeID);     
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Target;
use App\Targetgroup;
use App\Reservation;

class ReservationController extends Controller
{
    protected $today;

    public function __construct(Request $r) {

        $this->today = date('Y-m-d');
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

    public function showReservation(Request $request, $ryhmaID, $kohdeID, $varausID) {
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

    protected function checkMinMaxReservationLength($startdate, $enddate, Target $target) {
        $date1 = new \DateTime($startdate);
        $date2 = new \DateTime($enddate);
        $diff = $date2->diff($date1)->format("%a") + 1;

        if ($diff > $target->maxReservationLength) return 1;
        if ($diff < $target->minReservationLength) return -1;
        return 0;

    }

    protected function checkTwoPendingReservationsBan(Target $target, User $user) {

        if ($target->allowTwoReservationsBySameUser == 0) {
            // Lets search for reservations
            $found = $target->reservations()->where('user_id', $user->id)->where('enddate', '>', $this->today)->first();

            if ($found) return true;
        }

        return false;

    }

    // POST route
    public function createReservation(Request $request, $ryhmaID, $kohdeID) {

        $target = Target::findOrFail($kohdeID);

        $validator = \Validator::make($request->all(), Reservation::suomiValidationRules());
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();            
        }

        // Most of this validation code should probably live in a service class or somewhere
        // But lets keep it here because we are not planning to support multiple types of UIs or anything

        // First checkpoint of validations passed
        // We still have to check that reservation does not overlap with other reservations
        // And check that user has no other reservations active if allowTwoReservationsBySameUser is set false

        $input = $request->all();
        $input['startdate'] = date('Y-m-d', strtotime($input['startdate']));
        $input['enddate']   = date('Y-m-d', strtotime($input['enddate']));

        // Check that if allowTwoReservationsBySameUser is false then user does not have pending reservations
        if ($this->checkTwoPendingReservationsBan($target, \Auth::user())) {
            // Fails -> user can not add new reservation
            $request->session()->flash('operationfail', 'Varaus epäonnistui. Kohde ei salli samalla käyttäjällä olevan kahta varausta, jotka eivät ole päättyneet.');
            return back()->withInput();           
        }

        

        // Next lets check startdate is same or before enddate
        if ($input['startdate'] > $input['enddate']) {
            $request->session()->flash('operationfail', 'Varaus epäonnistui. Tarkista päivämäärät ja niiden järjestys.');
            return back()->withInput();            
        }

        // Lets check it is not 'historical' (startdate has at least today as its value)
        if ($input['startdate'] < date('Y-m-d')) {
             $request->session()->flash('operationfail', 'Varaus epäonnistui. Et voi tehdä varausta menneisyyteen.');
            return back()->withInput();                 
        }

        // Then lets check target allows this long/short reservation
        // Returns zero is all is fine
        $res = $this->checkMinMaxReservationLength($input['startdate'], $input['enddate'], $target);
        if ($res == 1) {
            $request->session()->flash('operationfail', 'Varaus epäonnistui - liian pitkä varaus. Maksimikesto on ' . $target->maxReservationLength . ' päivää.');
            return back()->withInput(); 
        } else if ($res == -1) {
            $request->session()->flash('operationfail', 'Varaus epäonnistui - liian lyhyt varaus. Minimikesto on ' . $target->minReservationLength .  ' päivää.');
            return back()->withInput(); 
        }


        $input['user_id'] = \Auth::id();
        $input['original_user_id'] = \Auth::id();
        $input['target_id'] = $kohdeID;

        // We need to start transaction here

        $failed = false;
        $varausID = 0;
        // Works!
        try {
            \DB::transaction(function () use ($kohdeID, $input, $request, &$failed, &$varausID) {
                // Check that there are no overlapping
                $found = Reservation::where('target_id', $kohdeID)->where('enddate', '>=', $input['startdate'])->where('startDate', '<=', $input['enddate'])->first();

                if ($found) {
                    throw new \Exception();
                }
                /*
                if (!$this->checkReservationOverlap($kohdeID, $input['startdate'], $input['enddate'])) {
                    $request->session()->flash('operationfail', 'Varausta epäonnistui. Tarkista päivämäärät. Et voi varata päivälle, jolle on jo varaus olemassa.');
                    return back()->withInput();

                }
                */
                $reservation = Reservation::create($input);
                $varausID    = $reservation->id; // Hack my life. We inject freshly-created reservation's id to outer call frame.
            });
        } catch (\Exception $e) {
            $failed = true;
        }

        // Very hacky.
        if (!$failed) {
            // Success
            $request->session()->flash('operationsuccess', 'Olet onnistuneesti tehnyt varauksen! Varauksen tiedot alla.'); 
            return redirect()->route('varausinfo', ['ryhmaID' => $ryhmaID, 'kohdeID' => $kohdeID, 'varausID' => $varausID]);

        } else {
            $request->session()->flash('operationfail', 'Varaus epäonnistui. Tarkista päivämäärät etteivät ne mene päällekkäin jo varattujen kanssa.');
            return back()->withInput();
        }



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


    // Steps to reservation creation
    public function reservationCreationStep1(Request $request, $ryhmaID) {
        $group = Targetgroup::with('targets')->findOrFail($ryhmaID);
        return view('member/creation/step1')->with('targets', $group->targets);
    }

    public function reservationCreationStep2(Request $request, $ryhmaID, $kohdeID) {
        // Return JS app
        $target = Target::with('reservations')->findOrFail($kohdeID);
        return view('member/creation/step2')->with('target', $target);
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

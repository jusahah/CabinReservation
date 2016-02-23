<?php

namespace App\Http\Middleware;

use Closure;
use App\Reservation;

class IsOwnerOfReservation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $varausID = $request->route('varausID');
        $varaus = Reservation::findOrFail($varausID);
        if (\Auth::user() != $varaus->user) {
            return back()->with('operationfail', 'Et voi käsitellä toisen käyttäjän varausta.');
        }

        return $next($request);
    }
}

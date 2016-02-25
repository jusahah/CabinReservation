<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Mail;
use App\Reservation;
use App\User;
use App\Target;
use App\Targetgroup;


class EmailServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Reservation::created(function($reservation) {
            // New reservation was like created you know...
            // We need to send email to those who give a fuck.
            $target = $reservation->target;
            // Check if this target has 'email notify'-setting on
            if ($target->emailWhenSomebodyReserves) {
                // It is on
                // Spread the word
                $group = $target->targetgroup;
                $members = $group->members()->get();

                foreach ($members as $key => $user) {
                    if ($user->emailNotificationsOn) {
                        Mail::raw($this->buildNewReservationText($reservation, $target), function($m) use ($user, $target) {
                            $m->from('varausmestari@varausmestari.fi', 'Varausmestari.fi');
                            $m->to($user->email, $user->name)->subject('Uusi varaus (' . $target->name . ')');  
                        });
                    }

                }
               
            }
        });

        Reservation::deleted(function($reservation) {
            $target = $reservation->target;
            // Check if this target has 'email notify'-setting on
            if ($target->emailWhenSomebodyCancels) {
                // It is on
                // Spread the word
                $group = $target->targetgroup;
                $members = $group->members()->get();

                foreach ($members as $key => $user) {   
                    // Send only if user has email notifications on
                    if ($user->emailNotificationsOn) {
                        Mail::raw($this->buildCancelReservationText($reservation, $target), function($m) use ($user, $target) {
                            $m->from('varausmestari@varausmestari.fi', 'Varausmestari.fi');
                            $m->to($user->email, $user->name)->subject('Varaus peruttu (' . $target->name . ')');  
                        });                        
                    }             

               }
            }         
        });      
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    protected function buildNewReservationText(Reservation $reservation, Target $target) {
        return "Varaus käyttäjältä " . $reservation->user->name . " kohteeseen " . $target->name . " aikavälille " . date('d.m', strtotime($reservation->startdate)) . " - " . date('d.m', strtotime($reservation->enddate));
    
    }
    protected function buildCancelReservationText(Reservation $reservation, Target $target) {
        return "Varaus peruttu: käyttäjä " . $reservation->user->name . " kohteeseen " . $target->name . " aikavälille " . date('d.m', strtotime($reservation->startdate)) . " - " . date('d.m', strtotime($reservation->enddate));
    
    }
}

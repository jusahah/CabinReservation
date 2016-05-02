<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'targetgroup_id', 'isActivated'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function targetgroup() {

        return $this->belongsTo('App\Targetgroup');
    }

    public function reservations() {
        return $this->hasMany('App\Reservation');
    }

    public function previousReservation() {
        $today = date('Y-m-d');
        $reservations = $this->reservations()->where('startdate', '<', $today)->get();
        if (count($reservations) == 0) return null;

        $sorted = $reservations->sortBy('startdate');
        return $sorted[0];

    }
    public function nextReservation() {
        $today = date('Y-m-d');
        $reservations = $this->reservations()->where('startdate', '>=', $today)->get();
        if (count($reservations) == 0) return null;

        $sorted = $reservations->sortBy('startdate');
        return $sorted[0];

    }

    public function previousReservationDate() {
        $prev = $this->previousReservation();
        if ($prev) return date('d.m', strtotime($prev->startdate)) . " - " . date('d.m', strtotime($prev->enddate));
        return "---";
    }

    public function nextReservationDate() {
        $next = $this->nextReservation();
        if ($next) return date('d.m', strtotime($next->startdate)) . " - " . date('d.m', strtotime($next->enddate));
        return "---";        
    }

    public function numberOfReservations() {
        return count($this->reservations()->get());
    }
}

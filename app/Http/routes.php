<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth', 'prefix' => 'member'], function () {
	Route::get('home', function() {
		return view('member/home');
	});

	// These routes require that user is already member of target group
	Route::group(['middleware' => 'assignedToTargetGroup'], function() {
		Route::get('kohteet', ['as' => 'kohteet', 'uses' => 'TargetController@index']);
		Route::get('kohteet/luo', ['as' => 'luokohdeform', 'uses' => 'TargetController@showTargetCreation']);

		Route::group(['middleware' => 'targetPartOfTargetGroup'], function() {
			Route::get('kohteet/{kohdeID}', ['as' => 'kohdeinfo', 'uses' => 'TargetController@showTargetInfo']);
			Route::get('kohteet/{kohdeID}/varaukset', ['as' => 'kohteenvaraukset', 'uses' => 'ReservationController@targetReservations']);
			Route::get('kohteet/{kohdeID}/varaukset/luo', ['as' => 'luovarausform', 'uses' => 'ReservationController@showReservationCreation']);
			Route::post('kohteet/{kohdeID}/varaukset', ['as' => 'luovaraus', 'uses' => 'ReservationController@createReservation']);

			Route::get('kohteet/{kohdeID}/varaukset/{varausID}', ['as' => 'varausinfo', 'uses' => 'ReservationController@showReservation']);
			Route::delete('kohteet/{kohdeID}/varaukset/{varausID}', ['as' => 'peruvaraus', 'uses' => 'ReservationController@deleteReservation']);

			Route::get('kohteet/{kohdeID}/ilmoitukset', ['as' => 'kohteenilmoitukset', 'uses' => 'AnnouncementController@targetAnnouncements']);
			Route::post('kohteet/{kohdeID}/ilmoitukset', ['as' => 'luoilmoitus', 'uses' => 'AnnouncementController@createAnnouncement']);



		});


		// Stuff only admin can do
		Route::group(['middleware' => 'isTargetGroupAdmin'], function() {
			Route::post('kohteet', ['as' => 'luokohde', 'uses' => 'TargetController@createTarget']);
			Route::put('kohteet', ['as' => 'muokkaakohde', 'uses' => 'TargetController@editTarget']);
		});



	});
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', ['as' => 'login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', ['as' => 'register', 'uses' => 'Auth\AuthController@postRegister']);

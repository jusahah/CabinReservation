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
	
	Route::get('etusivu', ['as' => 'eiryhmaa', 'uses' => 'PageController@showNoGroupFront']);
	Route::get('etsiryhma', ['as' => 'etsiryhmaa', 'uses' => 'PageController@searchForGroup']);
	// These routes require that user is already member of target group
	Route::group(['middleware' => 'assignedToTargetGroup'], function() {
		Route::get('{ryhmaID}/etusivu', ['as' => 'jasenetusivu', 'uses' => 'PageController@memberFront']);

		// Forbidden to use TargetController here as we are handling group-level details, not target-level.
		Route::get('{ryhmaID}/kohteet', ['as' => 'kohteet', 'uses' => 'TargetGroupController@index']);
		Route::get('{ryhmaID}/kohteet/luo', ['as' => 'luokohdeform', 'uses' => 'TargetGroupController@showTargetCreation']);
		Route::get('{ryhmaID}/jasenet', ['as' => 'ryhmanjasenet', 'uses' => 'TargetGroupController@showMembers']);
		Route::get('{ryhmaID}/loki', ['as' => 'ryhmanloki', 'uses' => 'TargetGroupController@showLog']);

		Route::get('{ryhmaID}/jasenet', ['as' => 'ryhmanjasenet', 'uses' => 'TargetGroupController@showMembers']);

		// Actions that require target being part of a group
		Route::group(['middleware' => 'targetPartOfTargetGroup'], function() {
			// Now we handle target-level details, so we dispatch to TargetController
			Route::get('{ryhmaID}/kohteet/{kohdeID}', ['as' => 'kohdeinfo', 'uses' => 'TargetController@showTargetInfo']);
			Route::get('kohteet/{kohdeID}/varaukset', ['as' => 'kohteenvaraukset', 'uses' => 'ReservationController@targetReservations']);
			Route::get('kohteet/{kohdeID}/varaukset/luo', ['as' => 'luovarausform', 'uses' => 'ReservationController@showReservationCreation']);
			Route::post('kohteet/{kohdeID}/varaukset', ['as' => 'luovaraus', 'uses' => 'ReservationController@createReservation']);
			Route::get('kohteet/{kohdeID}/varaukset/{varausID}', ['as' => 'varausinfo', 'uses' => 'ReservationController@showReservation']);
			
			// These are routes that only owner of reservation can hit
			Route::group(['middleware' => 'isOwnerOfReservation'], function() {
				Route::get('kohteet/{kohdeID}/varaukset/{varausID}/peru', ['as' => 'peruvaraus', 'uses' => 'ReservationController@deleteReservation']);
				Route::get('kohteet/{kohdeID}/varaukset/{varausID}/muokkaa', ['as' => 'muokkaavaraustaform', 'uses' => 'ReservationController@showEditReservation']);
				Route::post('kohteet/{kohdeID}/varaukset/{varausID}/muokkaa', ['as' => 'muokkaavarausta', 'uses' => 'ReservationController@editReservation']);

			});

			Route::get('kohteet/{kohdeID}/ilmoitukset', ['as' => 'kohteenilmoitukset', 'uses' => 'AnnouncementController@targetAnnouncements']);
			Route::post('kohteet/{kohdeID}/ilmoitukset', ['as' => 'luoilmoitus', 'uses' => 'AnnouncementController@createAnnouncement']);



		});


		// Stuff only admin can do
		Route::group(['middleware' => 'isTargetGroupAdmin'], function() {
			Route::post('{ryhmaID}/kohteet', ['as' => 'luokohde', 'uses' => 'TargetController@createTarget']);
			Route::put('kohteet', ['as' => 'muokkaakohde', 'uses' => 'TargetController@editTarget']);
			Route::get('kohteet/{kohdeID}/poista', ['as' => 'tuhoakohde', 'uses' => 'TargetController@askConfirmDeleteTarget']);
			Route::post('kohteet/{kohdeID}/poista', ['as' => 'tuhoakohdevahvistettu', 'uses' => 'TargetController@deleteTarget']);
			
			//Varaukset
			Route::get('kohteet/{kohdeID}/varaukset/{varausID}/poista', ['as' => 'tuhoavaraus', 'uses' => 'ReservationController@deleteReservationByAdmin']);
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

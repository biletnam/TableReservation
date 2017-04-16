<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//------------------------------------------------------
Route::resource('tables', 'TableController');
Route::resource('guests', 'GuestController');

//Route::get('reservations/calendar', 'ReservationController@calendar');
Route::get('reservations/date/{date}', 'ReservationController@reservationByDate');
Route::resource('reservations', 'ReservationController');

//------------------------------------------------------
// Route::get('/reservation/show', 'ReservationController@list');
// Route::get('/reservation/show/{id}', 'ReservationController@get');
//
// Route::get('/reservation/create', 'ReservationController@create');
// Route::get('/reservation/create/{name}/{email}/{phone}', 'ReservationController@create');
// Route::post('/reservation', 'ReservationController@create');
// Route::post('/reservation/{name}', 'ReservationController@create');
//
// Route::get('/reservation/update/{id}/{name}', 'ReservationController@update');
// Route::put('/reservation/{id}/{name}', 'ReservationController@update');
//
// Route::get('/reservation/delete/{id}', 'ReservationController@delete');
// Route::delete('/reservation/{id}', 'ReservationController@delete');

//-------------------------------------------------------
//Admin
Route::get('/admin', 'AdminController@main');

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
    return redirect('/login');
});

//------------------------------------------------------
Route::resource('tables', 'TableController');

Route::get('guests/find', 'GuestController@find');
Route::get('guests/find/name', 'GuestController@findByName');
Route::get('guests/find/email', 'GuestController@findByEmail');
Route::get('guests/find/phone', 'GuestController@findByPhone');
Route::resource('guests', 'GuestController');

Route::get('reservations/calendar', 'ReservationController@calendar');
Route::get('reservations/date/{date}', 'ReservationController@reservationByDate');
Route::get('reservations/create/selectDate', 'ReservationController@selectDate');
Route::get('reservations/create/{date}/{party}/{id}', 'ReservationController@create');
Route::get('reservations/{id}/confirm', 'ReservationController@confirm');
Route::resource('reservations', 'ReservationController');

Route::resource('hours', 'HoursController');

Route::resource('roles', 'RoleController');

//-------------------------------------------------------
//Admin
Route::get('/admin', 'AdminController@main');
Route::get('guests/remove/old', 'GuestController@removeOld');
Route::get('reservations/remove/old', 'ReservationController@removeOld');

Auth::routes();

Route::get('/home', 'HomeController@index');

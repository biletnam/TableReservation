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

Route::any('/main', function(){
  return view('main');
});

Route::get('user/{id}', 'UserController@show');

//------------------------------------------------------
Route::resource('tables', 'TableController');

// Route::get('/table/show', 'TableController@list');
// Route::get('/table/show/{id}', 'TableController@get');
//
// Route::get('/table/create', 'TableController@create');
// Route::get('/table/create/{name}', 'TableController@create');
// Route::post('/table', 'TableController@create');
// Route::post('/table/{name}', 'TableController@create');
//
// Route::get('/table/update/{id}/{name}', 'TableController@update');
// Route::put('/table/{id}/{name}', 'TableController@update');
//
// Route::get('/table/delete/{id}', 'TableController@delete');
// Route::delete('/table/{id}', 'TableController@delete');



//------------------------------------------------------
Route::get('/guest/show', 'GuestController@list');
Route::get('/guest/show/{id}', 'GuestController@get');

Route::get('/guest/create', 'GuestController@create');
Route::get('/guest/create/{name}/{email}/{phone}', 'GuestController@create');
Route::post('/guest', 'GuestController@create');
Route::post('/guest/{name}', 'GuestController@create');

Route::get('/guest/update/{id}/{name}', 'GuestController@update');
Route::put('/guest/{id}/{name}', 'GuestController@update');

Route::get('/guest/delete/{id}', 'GuestController@delete');
Route::delete('/guest/{id}', 'GuestController@delete');

//------------------------------------------------------
Route::get('/reservation/show', 'ReservationController@list');
Route::get('/reservation/show/{id}', 'ReservationController@get');

Route::get('/reservation/create', 'ReservationController@create');
Route::get('/reservation/create/{name}/{email}/{phone}', 'ReservationController@create');
Route::post('/reservation', 'ReservationController@create');
Route::post('/reservation/{name}', 'ReservationController@create');

Route::get('/reservation/update/{id}/{name}', 'ReservationController@update');
Route::put('/reservation/{id}/{name}', 'ReservationController@update');

Route::get('/reservation/delete/{id}', 'ReservationController@delete');
Route::delete('/reservation/{id}', 'ReservationController@delete');

//-------------------------------------------------------
//Admin
Route::get('/admin', 'AdminController@main');

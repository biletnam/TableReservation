<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
  public function list(Request $request)
  {
     return Reservation::all();
  }

  public function get(Request $request)
  {
     return Reservation::find($request->id);
  }

  public function create(Request $request)
  {
    $reservation = new Reservation;
    $reservation->name = ($request->name)? $request->name: 'Guest';
    $reservation->email = ($request->email)? $request->email: 'n/a';
    $reservation->phone = ($request->phone)? $request->phone: 'n/a';
    $reservation->save();

    return $reservation;
  }
  public function update(Reservation $request){
    $reservation = Reservation::find($request->id);
    $reservation->name = $request->name;
    $reservation->save();

    return $reservation;
  }

}

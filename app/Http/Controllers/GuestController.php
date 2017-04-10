<?php

namespace App\Http\Controllers;

use App\Guest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuestController extends Controller
{
  public function list(Request $request)
  {
     return Guest::all();
  }

  public function get(Request $request)
  {
     return Guest::find($request->id);
  }

  public function create(Request $request)
  {
    $guest = new Guest;
    $guest->name = ($request->name)? $request->name: 'Guest';
    $guest->email = ($request->email)? $request->email: 'n/a';
    $guest->phone = ($request->phone)? $request->phone: 'n/a';
    $guest->save();

    return $guest;
  }
  public function update(Request $request){
    $guest = Guest::find($request->id);
    $guest->name = $request->name;
    $guest->save();

    return $guest;
  }

}

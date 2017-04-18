<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
  public function main(Request $request)
  {
    $reservations = App\Reservation::where('status', 'requested')->get();
    foreach ($reservations as $reservation) {
      $table = App\Table::find($reservation->table_id);
      $guest = App\Guest::find($reservation->guest_id);
      if(isset($table) && isset($guest)){
        $reservation->table = $table;
        $reservation->$guest = $guest;
      }
    }
    return view('admin.main', ['reservations'=> $reservations]);
  }

}

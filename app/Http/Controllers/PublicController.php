<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use DateTime;
use DateInterval;

class PublicController extends Controller
{
    public function find(Request $request){
      $party_size = (isset($request->party)) ? $request->party : 0;
      $reservations = App\Reservation::getAvailableReservations(
        date_create($request->date)->format('Y-m-d'), $party_size
      );

      //initialize full time slots
      $slots = ["header"];
      for ($i=1; $i < sizeof($reservations[0]); $i++) {
        array_push($slots, false);
      }
      //find open times amongst all tables
      //for($t = 1; $t < sizeof($reservations); $t++){
      for($t = sizeof($reservations)-1; $t > 0; $t--){
        for($h = 1; $h < sizeof($reservations[0]); $h++){
          if($reservations[$t][$h] == false){
            $slots[$h] = $reservations[$t][0]['id'];
          }
        }
      }
      //translate available slots into valid times array to be returned
      $time_slots = [];
      for($i=1; $i < sizeof($slots); $i++){
        if($slots[$i] != false){
          array_push($time_slots, [$reservations[0][$i], $slots[$i]]);
        }
      }

      // var_dump("<pre>", $time_slots, "</pre>");

      return view('public/main', [
        'time_slots' => $time_slots
      ]);
    }
    public function confirm(Request $request){
      if(!isset($request->table_id, $request->party_size,
        $request->time,
        $request->customer_name, $request->customer_phone) ){
        return view('layouts.results', [
          'redirect' => '/reservations',
          'msg'=>'Missing information',
          'status'=>'error'
        ]);
      }
      $end_time = new DateTime($request->date . " " . $request->time);
      date_add($end_time, new DateInterval('PT90M'));
      $start_time = new DateTime($request->date . " " . $request->time);


      //verify if reservation is occupied
      $date = date_create($request->date);
      //start time taken
      $validation1 = App\Reservation::whereRaw('date = ? AND start_time >= ? AND ? <= end_time AND table_id = ?', [
        $start_time->format('Y-m-d'), $start_time->format('Y-m-d H:i:s'), $start_time->format('Y-m-d H:i:s'), $request->table_id
      ])->get();
      //end time taken
      $validation2 = App\Reservation::whereRaw('date = ? AND start_time >= ? AND ? <= end_time AND table_id = ?', [
        $end_time->format('Y-m-d'), $end_time->format('Y-m-d H:i:s'), $end_time->format('Y-m-d H:i:s'), $request->table_id
      ])->get();
      if(sizeof($validation1)> 0 || sizeof($validation2)>0){
        return view('layouts.results', [
          'redirect' => '/reservations',
          'msg'=>'This reservation conflicts with an existing reservation',
          'status'=>'error'
        ]);
      }

      $guest = new App\Guest;
      $guest->name = $request->customer_name;
      $guest->phone = $request->customer_phone;
      $guest->email = (isset($request->customer_email)) ? $request->customer_email : 'N/A';
      $guest->save();

      $reservation = new App\Reservation;
      $reservation->date = $start_time->format('Y-m-d');
      $reservation->start_time = $start_time;
      $reservation->end_time = $end_time;
      $reservation->party_size = $request->party_size;
      $reservation->guest_id = $guest->id;
      $reservation->table_id = $request->table_id;
      $reservation->status = (isset($request->status))?$request->status:'requested';
      $reservation->save();

      return view('layouts.results', [
        'redirect' => '/',
        'msg'=>'Your Reservation has been requested. A member of our staff will contact you to confirm your reservation soon.',
        'status'=>'success'
      ]);
    }
}

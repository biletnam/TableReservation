<?php

namespace App\Http\Controllers;

use Log;
use DateTime;
use DateInterval;
use App\Reservation;
use App\Table;
use App\Guest;
use App\Hours;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $reservations = Reservation::where('date','>=', date_format(date_create('now'),'Y-m-d') )
      ->orderBy('start_time', 'ASC')->get();
    //$reservations = Reservation::all()->orderBy('start_time', 'DESC')->get();

    foreach ($reservations as $reservation) {
      $table = Table::find($reservation->table_id);
      $guest = Guest::find($reservation->guest_id);
      if(isset($table) && isset($guest)){
        $reservation->table = $table;
        $reservation->guest = $guest;
      }
    }
    return view('reservation/index', ['reservations' => $reservations]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create($date, $party, $id)
  {

    $temp = explode('-', $id);
    $hour = floor($temp[0]/100);
    $minutes = ($temp[0]%100);
    $start_time = new DateTime($date);
    $start_time->add(new DateInterval('PT' . $hour . 'H'));
    $start_time->add(new DateInterval('PT' . $minutes . 'M'));
    $temp_time = clone $start_time;
    $end_time = $temp_time->add(new DateInterval('PT90M'));
    return view('reservation/create',[
      'date' => $start_time->format('Y-m-d'),
      'start_time' => $start_time,
      'end_time' => $end_time,
      'party' => $party,
      'tableId' => $temp[1]
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

    if(!isset($request->table_id, $request->party,
      $request->start_time, $request->end_time,
      $request->customer_name, $request->customer_phone) ){
      return view('layouts.results', [
        'redirect' => '/reservations',
        'msg'=>'Missing information',
        'status'=>'error'
      ]);
    }
    $end_time = new DateTime($request->date . " " . $request->end_time);
    $start_time = new DateTime($request->start_time);
    if($start_time > $end_time){
      return view('layouts.results', [
        'redirect' => '/reservations',
        'msg'=>'End time is before start time',
        'status'=>'error'
      ]);
    }

    //verify if reservation is occupied
    $date = date_create($request->date);
    //start time taken
    $validation1 = Reservation::whereRaw('date = ? AND start_time >= ? AND ? <= end_time AND table_id = ?', [
      $start_time->format('Y-m-d'), $start_time->format('Y-m-d H:i:s'), $start_time->format('Y-m-d H:i:s'), $request->table_id
    ])->get();
    //end time taken
    $validation2 = Reservation::whereRaw('date = ? AND start_time >= ? AND ? <= end_time AND table_id = ?', [
      $end_time->format('Y-m-d'), $end_time->format('Y-m-d H:i:s'), $end_time->format('Y-m-d H:i:s'), $request->table_id
    ])->get();
    if(sizeof($validation1)> 0 || sizeof($validation2)>0){
      return view('layouts.results', [
        'redirect' => '/reservations',
        'msg'=>'This reservation conflicts with an existing reservation',
        'status'=>'error'
      ]);
    }

    $guest = new Guest;
    $guest->name = $request->customer_name;
    $guest->phone = $request->customer_phone;
    $guest->email = (isset($request->customer_email)) ? $request->customer_email : 'N/A';
    $guest->save();

    $reservation = new Reservation;
    $reservation->date = $start_time->format('Y-m-d');
    $reservation->start_time = $start_time;
    $reservation->end_time = $end_time;
    $reservation->party_size = $request->party;
    $reservation->guest_id = $guest->id;
    $reservation->table_id = $request->table_id;
    $reservation->status = (isset($request->status))?$request->status:'requested';
    $reservation->save();

    return view('layouts.results', [
      'redirect' => '/reservations',
      'msg'=>'New Guest and Reservation Added',
      'status'=>'success'
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $reservation = Reservation::find($id)->load('guest');
    $guest = Guest::find($reservation->guest_id);
    $reservation->guest_name = $guest->name;
    $reservation->guest_phone = $guest->phone;
    $reservation->guest_email = $guest->email;

      return view('layouts.show', [
        'title'=>'Reservation',
        'model' => $reservation
      ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      return view('reservation/edit', ['reservation'=>Reservation::find($id)]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
      if(!isset($request->party_size, $request->status) ){
        return view('layouts.results', [
          'redirect' => '/reservations',
          'msg'=>'Reservation information missing',
          'status'=>'error'
        ]);
      }
      $reservation = Reservation::find($id);
      $reservation->party_size =  $request->party_size;
      $reservation->status = $request->status;
      $result = $reservation->save();

      if($result){
        return view('layouts.results', [
          'redirect' => '/reservations',
          'msg'=>'Reservation Updated: ',
          'status'=>'success'
        ]);
      }else{
        return view('layouts.results', [
          'redirect' => '/reservations',
          'msg'=>'Update Failed',
          'status'=>'error'
        ]);
      }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $reservation = Reservation::find($id);
    $result = Reservation::destroy($id);
    if($result){
      return view('layouts.results', [
        'redirect' => '/reservations',
        'msg'=>'Reservation Deleted: ' . $reservation->name,
        'status'=>'success'
      ]);
    }else{
      return view('layouts.results', [
        'redirect' => '/reservations',
        'msg'=>'Deletion failed',
        'status'=>'error'
      ]);
    }

  }
  public function calendar(){
    $today = new DateTime();

    $reservations = DB::table('reservations')
                     ->select(DB::raw('count(*) as count, date'))
                     ->where('date', '>=', date_format(date_create('now'),'Y-m-d') )
                     ->groupBy(['date'])
                     ->orderBy('date', 'ASC')
                     ->get();
    // $reservations = [];
    // foreach ($results as $k=>$r) {
    //   $reservations = array_merge_recursive($reservations,
    //   [ $r->date =>
    //     [ 'count' => $r->count,
    //      'status' => $r->status ]
    //   ]);
    // }
    return view('reservation/calendar', ['reservations' => $reservations]);

  }
  /**
   * show all reservations in a day-view for given date
   *
   * @param string date in format('Y-m-d')
   * @return \Illuminate\Http\Responses
   */
  public function reservationByDate($date){
    //list reservations for single date

    $date = new DateTime($date);

    $reservations = Reservation::whereRaw('date = ?  ORDER BY start_time ASC', [
      $date->format('Y-m-d')
    ])->get();
    foreach ($reservations as $reservation) {
      $table = Table::find($reservation->table_id);
      $guest = Guest::find($reservation->guest_id);
      if(isset($table) && isset($guest)){
        $reservation->table = $table;
        $reservation->guest = $guest;
      }
    }

    return view('reservation/by_date', [
      'reservationSlots' => Reservation::getAvailableReservations($date->format('Y-m-d')),
      'reservations' => $reservations,
      'date' => $date->format('M d, Y')
    ]);
  }
  /**
   * show all avaliable reservation slots in a day-view for given date
   *
   * @param Request $date in string
   * @return \Illuminate\Http\Responses
   */
  public function selectDate(Request $request)
  {
    if (!isset($request->date)){
      return view('reservation/add_selectDate');
    }

    $party_size = (isset($request->party)?$request->party:0);
    $date = new DateTime($request->date);

    $reservations = Reservation::whereRaw('date = ? ORDER BY start_time ASC', [
      $date->format('Y-m-d')
    ])->get();


    return view('reservation/add_selectDate', [
      'reservationSlots' => Reservation::getAvailableReservations($date->format('Y-m-d'),$party_size),
      'reservations'=>$reservations,
      'date'=>$date,
      'party'=>$party_size
    ]);
  }
  /**
   * Remove all past reservations
   *
   * @return \Illuminate\Http\Responses
   */
  public function removeOld(){
    $date = new DateTime();
    $result = DB::table('reservations')->where('date', '<', $date->format('Y-m-d'))->delete();
    return view('layouts.results', [
      'redirect' => '/reservations',
      'msg'=> $result . ' Old Reservations Removed',
      'status'=>'success'
    ]);
  }
  /**
   * change status of reservation to confirmed
   *
   * @param reservation id
   * @return \Illuminate\Http\Responses
   */
  public function confirm($id){
    $reservation = Reservation::find($id);
    $reservation->status = 'confirmed';
    $reservation->save();
    return view('layouts.results', [
      'redirect' => '/admin',
      'msg'=> 'Reservation Confirmed',
      'status'=>'success'
    ]);
  }

}

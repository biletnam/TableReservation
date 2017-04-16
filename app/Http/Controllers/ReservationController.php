<?php

namespace App\Http\Controllers;

use Log;
use DateTime;
use DateInterval;
use App\Reservation;
use App\Table;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $reservations = Reservation::orderBy('start_time', 'ASC')->get();
    //$reservations = Reservation::all()->orderBy('start_time', 'DESC')->get();

    foreach ($reservations as $reservation) {
      $table = Reservation::find($reservation->id)->table;
      $guest = Reservation::find($reservation->id)->guest;
      if(isset($table) && isset($guest)){
        $reservation->table = $table;
        $reservation->$guest = $guest;
      }
    }

  //  print('<pre>');
  //  var_dump($reservations);
    return view('admin.reservations_show', ['reservations' => $reservations]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.reservation_add');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // if(!isset($request->name) || !isset($request->seats) ){
    //   return view('layouts.results', [
    //     'redirect' => '/tables',
    //     'msg'=>'Table information missing',
    //     'status'=>'error'
    //   ]);
    // }
    // $table = new Table;
    // $table->name = ($request->name)? $request->name: 'Table';
    // $table->seats = ($request->seats)? $request->seats: 0;
    // $table->save();
    //
    // return view('layouts.results', [
    //   'redirect' => '/tables',
    //   'msg'=>'New Table Added',
    //   'status'=>'success'
    // ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //return view('layouts.show', ['model' => Table::find($id)]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      //return view('admin.table_edit', ['table' => Table::find($id)]);
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
      // if(!isset($request->name) || !isset($request->seats) ){
      //   return view('layouts.results', [
      //     'redirect' => '/tables',
      //     'msg'=>'Table information missing',
      //     'status'=>'error'
      //   ]);
      // }
      // $table = Table::find($id);
      // $table->name =  $request->name;
      // $table->seats = $request->seats;
      // $result = $table->save();
      //
      // if($result){
      //   return view('layouts.results', [
      //     'redirect' => '/tables',
      //     'msg'=>'Table Updated: ' . $table->name,
      //     'status'=>'success'
      //   ]);
      // }else{
      //   return view('layouts.results', [
      //     'redirect' => '/tables',
      //     'msg'=>'Update Failed',
      //     'status'=>'error'
      //   ]);
      // }
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
    return view('admin.calendar');
  }
  public function reservationByDate($date){
    //list reservations for single date

    $start = new DateTime($date);
    $end = new DateTime($date);
    $end->add(new DateInterval('P1D'));

    $reservations = Reservation::whereRaw('start_time >= ? AND end_time < ? ORDER BY start_time ASC', [
      $start->format('Y-m-d'), $end->format('Y-m-d')
    ])->get();

    return view('admin.reservation_by_date', [
      'reservations' => $reservations,
      'tables' => Table::all(),
      'date' => $start->format('M d, Y')
    ]);
  }
  // public function list(Request $request)
  // {
  //    return Reservation::all();
  // }
  //
  // public function get(Request $request)
  // {
  //    return Reservation::find($request->id);
  // }
  //
  // public function create(Request $request)
  // {
  //   $reservation = new Reservation;
  //   $reservation->name = ($request->name)? $request->name: 'Guest';
  //   $reservation->email = ($request->email)? $request->email: 'n/a';
  //   $reservation->phone = ($request->phone)? $request->phone: 'n/a';
  //   $reservation->save();
  //
  //   return $reservation;
  // }
  // public function update(Reservation $request){
  //   $reservation = Reservation::find($request->id);
  //   $reservation->name = $request->name;
  //   $reservation->save();
  //
  //   return $reservation;
  // }

}

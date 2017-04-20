<?php

namespace App\Http\Controllers;

use App\Guest;
use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GuestController extends Controller
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
        return view('admin.guests_show', ['guests' => Guest::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.guest_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if(!isset($request->name, $request->phone)){
        return view('layouts.results', [
          'redirect' => '/guests',
          'msg'=>'Guest information missing',
          'status'=>'error'
        ]);
      }
      $guest = new Guest;
      $guest->name = $request->name;
      $guest->email = (isset($request->email)) ? $request->email : 'N/A';
      $guest->phone = $request->phone;
      $guest->save();

      return view('layouts.results', [
        'redirect' => '/guests',
        'msg'=>'New Guest Added',
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
      return view('layouts.show', [
        'title'=>'Guest',
        'model' => Guest::find($id)
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
        return view('admin.guest_edit', ['guest' => Guest::find($id)]);
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
        if(!isset($request->name) || !isset($request->phone) || !isset($request->email) ){
          return view('layouts.results', [
            'redirect' => '/guests',
            'msg'=>'Guest information missing',
            'status'=>'error'
          ]);
        }
        $guest = Guest::find($id);
        $guest->name =  $request->name;
        $guest->phone = $request->phone;
        $guest->email = $request->email;
        $result = $guest->save();

        if($result){
          return view('layouts.results', [
            'redirect' => '/guests',
            'msg'=>'Guest Updated: ' . $guest->name,
            'status'=>'success'
          ]);
        }else{
          return view('layouts.results', [
            'redirect' => '/guests',
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
      $guest = Guest::find($id);
      $result = Guest::destroy($id);
      if($result){
        return view('layouts.results', [
          'redirect' => '/guests',
          'msg'=>'Guest Deleted: ' . $guest->name,
          'status'=>'success'
        ]);
      }else{
        return view('layouts.results', [
          'redirect' => '/guests',
          'msg'=>'Deletion failed',
          'status'=>'error'
        ]);
      }

    }
    public function find(){
      return view('admin/guest_find');
    }
    public function findByName(Request $request){
      //var_dump($name);
      $guests = Guest::whereRaw("name LIKE ?", ['%'.$request->name.'%'])->get();
      return view('admin.guests_show', ['guests' => $guests]);
    }
    public function findByPhone(Request $request){
      $guests = Guest::whereRaw("phone LIKE ?", ['%'.$request->phone.'%'])->get();
      return view('admin.guests_show', ['guests' => $guests]);
    }
    public function findByEmail(Request $request){
      $guests = Guest::whereRaw("email LIKE ?", ['%'.$request->email.'%'])->get();
      return view('admin.guests_show', ['guests' => $guests]);
    }
    public function removeOld(){
//       DELETE FROM A
// WHERE (field1, field2, ..., fieldN) IN
// ( SELECT *
//   FROM B
// ) ;
      $reservations = Reservation::all();
      $guest_ids = [];
      foreach ($reservations as $reservation) {
        array_push($guest_ids, $reservation->id);
      }

      //var_dump($guest_ids);
      $guests = Guest::all();
      $count =0;
      foreach ($guests as $guest) {
        if (!in_array($guest->id, $guest_ids)) {
          Guest::destroy($guest->id);
          $count++;
        }
      }

      //$result = DB::table('guests')->where('id', '!=', $guest_ids)->delete();
      return view('layouts.results', [
        'redirect' => '/guests',
        'msg'=> $count . ' Old Guests Removed',
        'status'=>'success'
      ]);
    }

}

<?php

namespace App\Http\Controllers;

use App\Guest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuestController extends Controller
{

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
      if(!isset($request->name) || !isset($request->phone) || !isset($request->email) ){
        return view('layouts.results', [
          'redirect' => '/guests',
          'msg'=>'Guest information missing',
          'status'=>'error'
        ]);
      }
      $guest = new Guest;
      $guest->name = $request->name;
      $guest->email = $request->email;
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
        return Table::find($id);
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

  // public function list(Request $request)
  // {
  //    return Guest::all();
  // }
  //
  // public function get(Request $request)
  // {
  //    return Guest::find($request->id);
  // }
  //
  // public function create(Request $request)
  // {
  //   $guest = new Guest;
  //   $guest->name = ($request->name)? $request->name: 'Guest';
  //   $guest->email = ($request->email)? $request->email: 'n/a';
  //   $guest->phone = ($request->phone)? $request->phone: 'n/a';
  //   $guest->save();
  //
  //   return $guest;
  // }
  // public function update(Request $request){
  //   $guest = Guest::find($request->id);
  //   $guest->name = $request->name;
  //   $guest->save();
  //
  //   return $guest;
  // }

}

<?php

namespace App\Http\Controllers;

use App\Hours;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HoursController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('admin.hours_show', [
        'hours' => Hours::orderBy('day', 'ASC')->get(),
        'days' => ['Sunday', "Monday", 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']
      ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.hours_add', [
      'days' => ['Sunday', "Monday", 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']
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
    if(!isset($request->day) || !isset($request->open) || !isset($request->close) ){
      return view('layouts.results', [
        'redirect' => '/hours',
        'msg'=>'Hours information missing',
        'status'=>'error'
      ]);
    }
    $hours = new Hours;
    $hours->day = $request->day;
    $hours->open = $request->open;
    $hours->close = $request->close;
    $hours->save();

    return view('layouts.results', [
      'redirect' => '/hours',
      'msg'=>'New Hours Added',
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
        'title'=>'Hours',
        'model' => Hours::find($id)
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
      return view('admin.hours_edit', [
        'hours' => Hours::find($id),
        'days' => ['Sunday', "Monday", 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']
      ]);
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
      if(!isset($request->day) || !isset($request->open) || !isset($request->close) ){
        return view('layouts.results', [
          'redirect' => '/hours',
          'msg'=>'Hours information missing',
          'status'=>'error'
        ]);
      }
      $hours = Hours::find($id);
      $hours->day =  $request->day;
      $hours->open = $request->open;
      $hours->close = $request->close;
      $hours->opened = $request->opened;
      $result = $hours->save();

      if($result){
        return view('layouts.results', [
          'redirect' => '/hours',
          'msg'=>'Hours Updated',
          'status'=>'success'
        ]);
      }else{
        return view('layouts.results', [
          'redirect' => '/hours',
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
    $hours = Hours::find($id);
    $result = Hours::destroy($id);
    if($result){
      return view('layouts.results', [
        'redirect' => '/hours',
        'msg'=>'Hours Deleted',
        'status'=>'success'
      ]);
    }else{
      return view('layouts.results', [
        'redirect' => '/hours',
        'msg'=>'Deletion failed',
        'status'=>'error'
      ]);
    }

  }

}

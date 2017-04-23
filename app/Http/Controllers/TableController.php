<?php

namespace App\Http\Controllers;

use App\Table;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TableController extends Controller
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
      return view('table/index', ['tables' => Table::all()]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('table/create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    if(!isset($request->name) || !isset($request->seats) ){
      return view('layouts.results', [
        'redirect' => '/tables',
        'msg'=>'Table information missing',
        'status'=>'error'
      ]);
    }
    $table = new Table;
    $table->name = ($request->name)? $request->name: 'Table';
    $table->seats = ($request->seats)? $request->seats: 0;
    $table->save();

    return view('layouts.results', [
      'redirect' => '/tables',
      'msg'=>'New Table Added',
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
        'title'=>'Table',
        'model' => Table::find($id)
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
      return view('table/edit', ['table' => Table::find($id)]);
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
      if(!isset($request->name) || !isset($request->seats) ){
        return view('layouts.results', [
          'redirect' => '/tables',
          'msg'=>'Table information missing',
          'status'=>'error'
        ]);
      }
      $table = Table::find($id);
      $table->name =  $request->name;
      $table->seats = $request->seats;
      $result = $table->save();

      if($result){
        return view('layouts.results', [
          'redirect' => '/tables',
          'msg'=>'Table Updated: ' . $table->name,
          'status'=>'success'
        ]);
      }else{
        return view('layouts.results', [
          'redirect' => '/tables',
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
    $table = Table::find($id);
    $result = Table::destroy($id);
    if($result){
      return view('layouts.results', [
        'redirect' => '/tables',
        'msg'=>'Table Deleted: ' . $table->name,
        'status'=>'success'
      ]);
    }else{
      return view('layouts.results', [
        'redirect' => '/tables',
        'msg'=>'Deletion failed',
        'status'=>'error'
      ]);
    }

  }

}

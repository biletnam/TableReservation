<?php

namespace App\Http\Controllers;

use App\Table;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TableController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('admin.tables_show', ['tables' => Table::all()]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.table_add');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
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
      return view('admin.table_edit', ['table' => Table::find($id)]);
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

<?php

namespace App\Http\Controllers;

use App\Table;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TableController extends Controller
{
  public function list(Request $request)
  {
     return Table::all();
  }

  public function get(Request $request)
  {
     return Table::find($request->id);
  }

  public function create(Request $request)
  {
    $table = new Table;
    $table->name = ($request->name)? $request->name: 'Table';
    $table->save();

    return $table;
  }
  public function update(Request $request){
    $table = Table::find($request->id);
    $table->name = $request->name;
    $table->save();

    return $table;
  }

}

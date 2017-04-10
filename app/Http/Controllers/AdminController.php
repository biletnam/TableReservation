<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
  public function main(Request $request)
  {
     return view('admin.main');
  }
  public function showTables(Request $request)
  {
     return view('admin.show_tables', ['tables' => App\Table::all()]);
  }

}

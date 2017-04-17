<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
  public function main(Request $request)
  {
    $statuses = DB::table('reservations')
       ->select(DB::raw('count(*) as count, status'))
      // ->where('date', '<>', 1)
       ->groupBy('status')
       ->get();
    $status = [];
    foreach ($statuses as $s) {
      $status += [$s->status => $s->count];
    }
     return view('admin.main', ['status'=> $status]);
  }

}

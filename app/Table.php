<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
  protected $table = 'tables';

  public function reservations()
  {
      return $this->belongsTo(Reservation::class);
  }
}

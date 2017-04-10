<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
  protected $table = 'guests';

  protected $fillable = [
      'name', 'email', 'phone',
  ];

  public function reservation()
  {
      return $this->belongsTo(Reservation::class);
  }
}

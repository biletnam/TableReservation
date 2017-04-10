<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
  protected $table = 'reservations';

  protected $fillable = [
      'reservation_time', 'party_size', 'duration',
  ];

  public function guest()
  {
     return $this->hasOne(Guest::class);
  }

  public function table()
  {
      return $this->hasOne(Table::class);
  }
}

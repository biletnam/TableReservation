<?php

namespace App;
use DateInterval;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
  protected $table = 'reservations';

  // protected $fillable = [
  //     'reservation_time', 'party_size', 'duration',
  // ];

  public function guest()
  {
     return $this->hasOne(Guest::class, 'id');
  }

  public function table()
  {
      return $this->hasOne(Table::class, 'id');
  }

  /**
   * Retrieve a '2D' nested array with available reservation slots
   *
   * @param  string $Database format('Y-m-d')
   * @param  int $party_size
   * @return mixed array
   */

  public static function getAvailableReservations($date, $party_size = 0){

    $reservation_schedule = [];

    //setup hours opened array incremented by 30 minute intervals
    $hoursOpen = Hours::getHoursOfOperationsByDate($date);
    $timeOpen = date_create($hoursOpen->open);
    $timeClosed = date_create($hoursOpen->close);
    $hourArray = ["hours"];
    for($t = $timeOpen; ($t) < ($timeClosed); date_add($t,new DateInterval('PT30M'))){
      array_push($hourArray, $t->format('H:i') );
    }
    array_push($reservation_schedule, $hourArray);
    //end of hours opened

    $tables = Table::where('seats', '>=', $party_size)->orderBy('seats')->get();
    // var_dump("<pre>",$tables->toArray(),"</pre>");

    $reservations = Reservation::where('date', $date)->get();
    // var_dump("<pre>", $reservations->toArray(), "</pre>");
    foreach ($tables as $table) {
      $reservationsForTable = [];
      foreach ($reservations as $reserv) {
        if($reserv->table_id == $table->id){
          array_push($reservationsForTable, [
            "open"=>date_create($reserv->start_time)->format("H:i"),
            "close"=>date_create($reserv->end_time)->format("H:i")
          ]);
        }
      }

      $temp = [$table->toArray()];
      $i = 1;
      while($i < sizeof($hourArray)){
        if(in_array(date_create($hourArray[$i])->format('H:i'), array_column($reservationsForTable,'open'))){
          $key = array_search(date_create($hourArray[$i])->format('H:i'), array_column($reservationsForTable,'open'));

          while( $i < sizeof($hourArray)
          && date_create($reservationsForTable[$key]['close']) > date_create($hourArray[$i]) ){
            array_push($temp, true);
            $i++;
          }
        }
        else{
          array_push($temp, false);
          $i++;
        }
      }
      array_push($reservation_schedule, $temp);
    }

    // var_dump("<pre>", $reservation_schedule, "</pre>");
    return $reservation_schedule;
  }
}

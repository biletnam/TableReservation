<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hours extends Model
{
    protected $table = 'hours';
    public function getDaysOfWeek(){
      return [
        '0'=>'Sunday',
        '1'=>'Monday',
        '2'=>'Tuesday',
        '3'=>'Wednesday',
        '4'=>'Thursday',
        '5'=>'Friday',
        '6'=>'Saturday'
      ];
    }
    public static function getHoursOfOperationsByDate($date){
      $day = date_create($date);
      $hoursOpen = Hours::where('day', $day->format('w'))->firstOrFail();
      //var_dump("<pre>", $hoursOpen->toArray(), "</pre>");
      return $hoursOpen;
    }
}

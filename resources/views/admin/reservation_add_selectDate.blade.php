@extends('layouts.app')

@section('title', 'Reservations')

@section('head')
<link rel="stylesheet" href="/css/jquery-ui.min.css">
<style>
  .taken{
    background-color: red;
  }
  .toosmall{
    background-color: grey;
  }
  .available{
    /*background-color: #2ab27b;*/
  }
</style>
@endsection

@section('content')

<!-- <p>Date: <input type="text" id="datepicker"></p> -->
<?php $date_f = (isset($date)? $date->format('m/d/y') : null)?>

{!!  Form::open( [
  'method' => 'get',
  'url' => '/reservations/create/selectDate',
  ]) !!}

<div class="input-group col-xs-12 col-sm-10 col-md-8">
  <span class="input-group-addon">
    Date:
  </span>
  {!! Form::text('date', $date_f, ['class' => 'form-control', 'id'=>'datepicker']) !!}
  <span class="input-group-addon">
    Party Size:
  </span>
  {!! Form::number('party', (isset($party)? $party : null), ['class' => 'form-control']) !!}
  <span class="input-group-btn">
    {!! Form::submit('Next', ['class' => 'btn btn-success']) !!}
  </span>
</div>
{!! Form::close() !!}

@if(isset($date))

  <h3>Availiablity for {{ $date->format('M d, Y') }}</h3>
  <table class="table text-center" id="schedule">
    <tr>
      <td>
        Table (Max Seats)
      </td>
      @foreach($tables as $table)
      <td>
       {{ $table->id}} ({{$table->seats}})
      </td>
      @endforeach
    </tr>
    @for( $i=8; $i<20 ; $i++ )

    <tr>
      <td>
        {{ ($i > 12)? $i-12 . ":00" : $i . ":00" }}
        {{ ($i >= 12)? "PM" : "AM" }}
      </td>
      @foreach($tables as $table)
        <td id='{{$i . "00-" . $table->id}}' class='
          {{ ($party > $table->seats )? 'toosmall' : 'available' }}
          '></td>
      @endforeach
    </tr>
    <tr>
      <td>
        {{ ($i > 12)? $i-12 . ":30" : $i . ":30" }}
        {{ ($i >= 12)? "PM" : "AM" }}
      </td>
      @foreach($tables as $table)
        <td id='{{$i . "50-" . $table->id}}' class= '
          {{ ($party > $table->seats )? 'toosmall' : 'available' }}
        '></td>
      @endforeach
    </tr>
    @endfor
  </table>
@endif
@endsection

@section('scripts')
  <script src="/js/jquery-ui.min.js"></script>
<script>

  document.addEventListener("DOMContentLoaded", function() {
    $( function() {
      $( "#datepicker" ).datepicker();
    } );

    @if(isset($reservations))
      @foreach($reservations as $reservation)
      //while start time <= end time
        <?php
          $start = intval(date_format( new DateTime($reservation->start_time), 'h')) . "00";
          $end = intval(date_format( new DateTime($reservation->end_time), 'h')) . "00";
        ?>
        @while ($start <= $end )
         <?php $cell = $start . '-' . $reservation->table_id  ?>
         //$("#{{$cell}}").css('background', 'red');
         $("#{{$cell}}").removeClass().addClass('taken');
         {{$start += 50}};
        @endwhile
      @endforeach

      //set url for available reservations
      $('.available').each(function(){
        var url = '/reservations/create/{{$date->format("Y-m-d")}}/{{$party}}/' + this.id;
        $(this).append('<a href="' + url + '"> ' +
          '<span class="glyphicon glyphicon-plus"></span>' +
        '</a>');
      });
    @endif



  });

</script>

@endsection

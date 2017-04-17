@extends('layouts.app')

@section('title', 'Reservations')

@section('head')
<style>
  .seated{
    text-decoration: line-through;
  }
  .released{
    color:red;
    text-decoration: line-through;
  }
</style>
@endsection

@section('content')

  <div class="panel panel-success">
    <div class="panel-heading">
      <span>Reservations for {{$date}}</span>
      <span class='pull-right'><a href="/reservations/create/selectDate">Add Reservation</a></span>
    </div>
    <table class="table">
      <tr>
        <th>Start</th>
        <th>End</th>
        <th>Table</th>
        <th>Guest</th>
        <th>Party</th>
        <th>Status</th>

        <th>Detail</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>

      @foreach ($reservations as $reservation)
      <tr class="{{$reservation->status}}">
        <td>{{ date_format( new DateTime($reservation->start_time), 'h:ia') }} </td>
        <td>{{ date_format( new DateTime($reservation->end_time), 'h:ia') }}</td>
        <td><a href="/tables/{{$reservation->table->id}}">{{$reservation->table->name}}</a></td>
        <td><a href="/guests/{{$reservation->guest->id}}">{{$reservation->guest->name}}</a></td>
        <td>{{$reservation->party_size}}</td>
        <td>{{$reservation->status}}</td>
        <td>
          <button class="btn btn-xs btn-default">
          <a href="/reservations/{{$reservation->id}}">
            <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
          </a>
          </button>
        </td>
        <td>
          <button class="btn btn-xs btn-default">
          <a href="/reservations/{{$reservation->id}}/edit">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
          </a>
          </button>
        </td>
        <td>

          {!!  Form::model($reservation, [
            'url' => '/reservations/' . $reservation->id,
            'method' => 'delete',
            'style' => 'display: inline-block'
            ]) !!}
            <button type="submit" class="btn btn-xs btn-danger">
              <span class="glyphicon glyphicon-remove" aria-hidden="true"/></span>
            </button>
          {!! Form::close() !!}

        </td>
      </tr>

      @endforeach
    </table>
  </div>
  <div>

    <table class="table text-center" id="schedule">
      <tr>
        <td>
          Table
        </td>
        @foreach($tables as $table)
        <td>
         {{ $table->id}}
        </td>
        @endforeach
      </tr>
      @for( $i=9; $i<20 ; $i++ )

      <tr>
        <td>
          {{ ($i > 12)? $i-12 . ":00" : $i . ":00" }}
          {{ ($i >= 12)? "PM" : "AM" }}
        </td>
        @foreach($tables as $table)
          <td id='{{$i . "00-" . $table->id}}'></td>
        @endforeach
      </tr>
      <tr>
        <td>
          {{ ($i > 12)? $i-12 . ":30" : $i . ":30" }}
          {{ ($i >= 12)? "PM" : "AM" }}
        </td>
        @foreach($tables as $table)
          <td id='{{$i . "50-" . $table->id}}'></td>
        @endforeach
      </tr>
      @endfor
    </table>
  </div>

@endsection

@section('scripts')
<script>
  document.addEventListener("DOMContentLoaded", function() {
    @foreach($reservations as $reservation)
    //while start time <= end time
      <?php
        $start = intval(date_format( new DateTime($reservation->start_time), 'h')) . "00";
        $end = intval(date_format( new DateTime($reservation->end_time), 'h')) . "00";
      ?>
      @while ($start <= $end )
       <?php $cell = $start . '-' . $reservation->table_id  ?>
       $("#{{$cell}}").css('background', 'red');
       {{$start += 50}};
      @endwhile
    @endforeach

  });



</script>
@endsection

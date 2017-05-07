@extends('layouts.app')

@section('title', 'Reservations')

@section('head')
<style>
  .seated{
    text-decoration: line-through;
    border:1px solid white;
  }
  .released{
    color:red;
    text-decoration: line-through;
    border:1px solid white;
  }
  .checked-in{
    color:green;
    font-weight: bolder;
    border:1px solid white;
  }
  .slot-taken{
    background:red;
    border:1px solid white;
  }
</style>
@endsection

@section('content')

  <div class="panel panel-success">
    <div class="panel-heading">
      <span>Reservations for {{$date}}</span>
      <span class='pull-right'>
        <a href="/reservations/create/selectDate?date={{date_format( new DateTime($date), 'm/d/Y')}}">
          Add Reservation
        </a>
      </span>
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
        <td>{{ date_format( new DateTime($reservation->start_time), 'g:ia') }} </td>
        <td>{{ date_format( new DateTime($reservation->end_time), 'g:ia') }}</td>
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
    <table class="table text-center" >
      <!-- table's first row/header -->
      <tr>
        <td>Table (Max Seats)</td>
        <!--  header for tables -->
        @for($t = 1;$t < sizeof($reservationSlots); $t++)
          <td>{{$reservationSlots[$t][0]['name']}} ({{$reservationSlots[$t][0]['seats']}})</td>
        @endfor
      </tr>
      <!-- iterate through each row -->
      @for($h = 1;$h < sizeof($reservationSlots[0]); $h++)
      <tr>
        <!-- col for time -->
        <td>{{date_create($reservationSlots[0][$h])->format('g:ia')}}</td>
        <!--  iterate through table reservations if taken for this time slot-->
        @for($t = 1;$t < sizeof($reservationSlots); $t++)
          <td <?php if($reservationSlots[$t][$h]){echo 'class="slot-taken"';} ?> ></td>
        @endfor
      </tr>
      @endfor
    </table>
  </div>

@endsection

@extends('layouts.app')

@section('title', 'Reservations')

@section('content')

  <div class="panel panel-success">
    <div class="panel-heading">
      <span>Reservations</span>
      <span class='pull-right'><a href="/reservations/calendar">Calendar View</a></span>
    </div>
    <table class="table">

      <?php $dates = [] ?>

    @foreach ($reservations as $reservation)

      <?php $date = date_format( new DateTime($reservation->start_time), 'M d, Y' ) ?>

      <?php
        if(!in_array( $date, $dates)){
          array_push($dates, $date);
      ?>
      <tr class="active">
        <td colspan="7" class='text-center'>
          <a href="/reservations/date/{{date_format( new DateTime($reservation->start_time), 'Y-m-d' )}}">
            {{ $date }}
          </a>
        </td>
      </tr>
      <tr>
        <th>Start</th>
        <th>End</th>
        <th>Table</th>
        <th>Guest</th>
        <th>Party</th>

        <th>Edit</th>
        <th>Delete</th>
      </tr>
      <?php
        }
      ?>

      <tr>
        <td>{{ date_format( new DateTime($reservation->start_time), 'h:ia') }} </td>
        <td>{{ date_format( new DateTime($reservation->end_time), 'h:ia') }}</td>
        <td><a href="/tables/{{$reservation->table->id}}">{{$reservation->table->name}}</a></td>
        <td><a href="/guests/{{$reservation->guest->id}}">{{$reservation->guest->name}}</a></td>
        <td>{{$reservation->party_size}}</td>
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

@endsection

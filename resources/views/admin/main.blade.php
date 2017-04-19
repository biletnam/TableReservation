@extends('layouts.app')

@section('title', 'Reservations')

@section('content')

<div class='col-xs-12 '>
  <div class="panel panel-success">
    <div class="panel-heading text-center">
      <span class="glyphicon glyphicon-alert"></span> Pending Reservations
    </div>
    <table class="table">
      <tr>
        <th>Date</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Party</th>
        <th>Confirm</th>
        <th>Edit</th>
      </tr>
      @foreach($reservations as $reservation)
      <tr>
        <td>{{date_format(new DateTime($reservation->date),'l, M d, Y')}}</td>
        <td>{{date_format(new DateTime($reservation->start_time),'H:ia')}}</td>
        <td>{{date_format(new DateTime($reservation->end_time),'H:ia')}}</td>
        <td>{{$reservation->guest->name}}</td>
        <td>{{$reservation->guest->phone}}</td>
        <td>{{$reservation->party_size}}</td>
        <td>
          <button class="btn btn-xs btn-default">
          <a href="/reservations/{{$reservation->id}}/confirm">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
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
      </tr>
      @endforeach
    </table>
  </div>
</div>

<div class='col-xs-6 col-sm-6 col-md-6 '>
  <div class="panel panel-success">
    <div class="panel-heading text-center">
      <span class="glyphicon glyphicon-time"></span> Hours of Operation
    </div>
    <table class="table">
      <tr>
        <th>Day</th>
        <th>Open</th>
        <th>Close</th>
      </tr>
      @foreach($hours as $hour)
      <tr>
        <td>{{ $days[$hour->day] }}</td>
        <td>{{ date_format(new DateTime($hour->open),'H:ia') }}</td>
        <td>{{ date_format(new DateTime($hour->close), 'H:ia') }}</td>
      </tr>
      @endforeach
    </table>
  </div>
</div>

<div class='col-xs-6 col-sm-6 col-md-6 '>
  <div class="panel panel-success">
    <div class="panel-heading text-center">
      <span class="glyphicon glyphicon-trash"></span> Clean Up Options
    </div>
    <table class="table text-center">
      <tr>
        <td><a href="/reservations/remove/old">Delete Old Reservations</a></td>
      </tr>
      <tr>
        <td><a href="/guests/remove/old">Delete Guests w/o Reservations</a></td>
      </tr>
    </table>
  </div>
</div>

@endsection

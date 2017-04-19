@extends('layouts.app')

@section('title', 'Reservations')

@section('content')

<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2">
  <div class="panel panel-success">
    <div class="panel-heading">
      <span>Reservations</span>
      <span class='pull-right'><a href="/reservations/">Detail View</a></span>
    </div>
    <table class="table">

      <tr>
        <th>Date</th>
        <th>Total</th>
      </tr>
      @foreach($reservations as $date)
      <?php $day = new DateTime($date->date)?>
      <tr>
        <td>
          <a href="/reservations/date/{{$day->format('Y-m-d')}}">
          {{$day->format('l, M d, Y')}}
          </a>
        </td>
        <td>{{$date->count}}</td>
      </tr>

      @endforeach

    </table>
  </div>
</div>
@endsection

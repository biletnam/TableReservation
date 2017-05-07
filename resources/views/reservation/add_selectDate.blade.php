@extends('layouts.app')

@section('title', 'Reservations')

@section('head')
<link rel="stylesheet" href="/css/jquery-ui.min.css">
<style>
  .slot-taken{
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

@if(isset($date, $reservationSlots[1]))

  <h3>Availiablity for {{ $date->format('M d, Y') }}</h3>
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
      <?php
        $url = "/reservations/create/" . $date->format('Y-m-d') . "/" . $party . "/" .
          date_create($reservationSlots[0][$h])->format('Hi') . "-" . $reservationSlots[$t][0]['id'] ;
      ?>
        @if($reservationSlots[$t][$h])
          <td class="slot-taken"></td>
        @else
          <td class='available'><a href="{{$url}}"><span class="glyphicon glyphicon-plus"></span></a></td>
        @endif
      @endfor
    </tr>
    @endfor
  </table>
@else
  <p class="bg-warning text-center">
    <span class="glyphicon glyphicon-alert"></span> No results for this search. Please adjust request
  </p>

@endif
@endsection

@section('scripts')
  <script src="/js/jquery-ui.min.js"></script>
  <script>
  document.addEventListener("DOMContentLoaded", function() {
    $( function() {
      $( "#datepicker" ).datepicker();
    } );
  });
  </script>
@endsection

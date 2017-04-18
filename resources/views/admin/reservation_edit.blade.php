@extends('layouts.app')

@section('title', 'Reservation - Edit')

@section('content')

  <?php $start_time = new DateTime($reservation->start_time) ?>
  <?php $end_time = new DateTime($reservation->end_time) ?>

  {!!  Form::model('App/Reservation', [
    'url' => '/reservations/' . $reservation->id,
    'method' => 'put',
    'class' => 'form-horizontal'
    ]) !!}

    <div class="form-group ">
      <h3 class="col-sm-offset-4 col-sm-4">Edit Reservation</h3>
    </div>

  <div class="form-group">
    {!! Form::label('id', 'ID', ['class'=> 'col-sm-4 control-label']) !!}

    <div class="col-sm-4">
        {!! Form::label('id', $reservation->id, ['class'=> 'control-label']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('date', 'Date', ['class'=> 'col-sm-4 control-label']) !!}

    <div class="col-sm-4">
        {!! Form::label('date', $start_time->format('M d, Y'), ['class'=> 'control-label']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('start_time', 'Start Time', ['class'=> 'col-sm-4 control-label']) !!}

    <div class="col-sm-4">
        {!! Form::label('start_time', $start_time->format('h:ia'), ['class'=> 'control-label']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('end_time', 'End Time', ['class'=> 'col-sm-4 control-label']) !!}

    <div class="col-sm-4">
        {!! Form::label('end_time', $end_time->format('h:ia'), ['class'=> 'control-label']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('party_size', 'Party Size', ['class'=> 'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
      {!! Form::number('party_size', $reservation->party_size, ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('status', 'Status', ['class'=> 'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
      {!! Form::select('status', [
        'requested' => 'requested',
        'confirmed' => 'confirmed',
        'seated' => 'seated',
        'released' => 'released'
      ], $reservation->status, ['class' => 'form-control']) !!}
    </div>
  </div>

  <div class="col-sm-offset-4 col-sm-4 text-right ">
    {!! Form::submit('Update Reservation', ['class' => 'btn btn-success']) !!}
  </div>

  {!! Form::close() !!}

  {!!  Form::model($reservation, [
    'url' => '/reservations/' . $reservation->id,
    'method' => 'delete'
    ]) !!}
    <div class="col-sm-offset-4 col-sm-4 text-left ">
      {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    </div>
  {!! Form::close() !!}

@endsection

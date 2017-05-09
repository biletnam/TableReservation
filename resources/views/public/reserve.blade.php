@extends('layouts.public')

@section('title', 'Reservations')

@section('head')
  <link rel="stylesheet" href="/css/jquery-ui.min.css">
@endsection

@section('content')
  <div class="container">
  <h2 class="col-sm-offset-4 col-sm-8">Confirm Reservation Details</h2>
  {!!  Form::open( [
    'method' => 'post',
    'url' => '/confirm',
    'class' => 'form-horizontal'
    ]) !!}

  {!! Form::hidden('table_id', $_GET['table_id']) !!}
  <div class="form-group">
    {!! Form::hidden('date', $_GET['date']) !!}
    {!! Form::label('date', 'Date:', ['class'=> 'col-xs-4 control-label']) !!}
    <div class="col-xs-8  col-sm-4">
      {!! Form::label('date', $_GET['date'], ['class' => ' control-label']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::hidden('time', $_GET['time']) !!}
    {!! Form::label('time', 'Time:', ['class'=> 'col-xs-4 control-label']) !!}
    <div class="col-xs-8  col-sm-4">
      {!! Form::label('time', $_GET['time'], ['class' => ' control-label']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::hidden('party_size', $_GET['party_size']) !!}
    {!! Form::label('party_size', 'Party Size:', ['class'=> 'col-xs-4 control-label']) !!}
    <div class="col-xs-8  col-sm-4">
      {!! Form::label('party_size', $_GET['party_size'], ['class' => ' control-label']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::hidden('customer_name', $_GET['fullname']) !!}
    {!! Form::label('customer_name', 'Full Name:', ['class'=> 'col-xs-4 control-label']) !!}
    <div class="col-xs-8  col-sm-4">
      {!! Form::label('customer_name', $_GET['fullname'], ['class' => ' control-label']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::hidden('email', !empty($_GET['email']) ? $_GET['email'] : 'N/A' ) !!}
    {!! Form::label('email', 'Email:', ['class'=> 'col-xs-4 control-label']) !!}
    <div class="col-xs-8  col-sm-4">
      {!! Form::label('email', !empty($_GET['email']) ? $_GET['email'] : 'N/A', ['class' => ' control-label']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::hidden('customer_phone', $_GET['phone']) !!}
    {!! Form::label('customer_phone', 'Phone:', ['class'=> 'col-xs-4 control-label']) !!}
    <div class="col-xs-8  col-sm-4">
      {!! Form::label('customer_phone', $_GET['phone'], ['class' => ' control-label']) !!}
    </div>
  </div>


  <div class="form-group">
    <span class="col-xs-offset-4 col-xs-8">
      {!! Form::submit('Confirm', ['class' => 'btn btn-success']) !!}
    </span>
  </div>
  {!! Form::close() !!}

  </div>

@endsection

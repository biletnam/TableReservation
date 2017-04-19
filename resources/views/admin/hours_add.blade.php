@extends('layouts.app')

@section('title', 'Hours - Add')

@section('content')

  {!!  Form::model('App/Hours', [
    'url' => '/hours/',
    'method' => 'post',
    'class' => 'form-horizontal'
    ]) !!}
    <div class="form-group ">
      <h3 class="col-sm-offset-4 col-sm-4">Add New Hours</h3>
    </div>

  <div class="form-group">

    {!! Form::label('day', 'Day ', ['class'=> 'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
      {{ Form::select('day', [
        '0' => 'Sunday',
        '1' => 'Monday',
        '2' => 'Tuesday',
        '3' => 'Wednesday',
        '4' => 'Thursday',
        '5' => 'Friday',
        '6' => 'Saturday'
        ], null, ['class' => 'form-control'] ) }}

    </div>
  </div>
  <div class="form-group">
    {!! Form::label('open', 'Open', ['class'=> 'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
      {!! Form::time('open', '08:00:00', ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('close', 'Closed', ['class'=> 'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
      {!! Form::time('close', '20:00:00', ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="col-sm-offset-4 col-sm-4 text-right">
    {!! Form::submit('Add Table', ['class' => 'btn btn-success']) !!}
  </div>

  {!! Form::close() !!}

@endsection

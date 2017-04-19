@extends('layouts.app')

@section('title', 'Hours - Edit')

@section('content')

  {!!  Form::model('App/Hours', [
    'url' => '/hours/' . $hours->id,
    'method' => 'put',
    'class' => 'form-horizontal'
    ]) !!}

    <div class="form-group ">
      <h3 class="col-sm-offset-4 col-sm-4">Edit Hours</h3>
    </div>

  <div class="form-group">
    {!! Form::label('id', 'ID', ['class'=> 'col-sm-4 control-label']) !!}

    <div class="col-sm-4">
        {!! Form::label('id', $hours->id, ['class'=> 'control-label']) !!}
    </div>
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
        ], $hours->day, ['class' => 'form-control'] ) }}

    </div>
  </div>
  <div class="form-group">
    {!! Form::label('open', 'Open', ['class'=> 'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
      {!! Form::time('open', $hours->open, ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('close', 'Closed', ['class'=> 'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
      {!! Form::time('close', $hours->close, ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="col-sm-offset-4 col-sm-4 text-right">
    {!! Form::submit('Update Hours', ['class' => 'btn btn-success']) !!}
  </div>

  {!! Form::close() !!}

@endsection

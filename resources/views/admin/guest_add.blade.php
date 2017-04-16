@extends('layouts.app')

@section('title', 'Guests - Add')

@section('content')

  {!!  Form::model('App/Guest', [
    'url' => '/guests/',
    'method' => 'post',
    'class' => 'form-horizontal'
    ]) !!}
    <div class="form-group ">
      <h3 class="col-sm-offset-4 col-sm-4">Add New Guest</h3>
    </div>

  <div class="form-group">
    {!! Form::label('name', 'Guest Name', ['class'=> 'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
      {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('email', 'Email', ['class'=> 'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
      {!! Form::email('email', null, ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('phone', 'Phone', ['class'=> 'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
      {!! Form::tel('phone', null, ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="col-sm-offset-4 col-sm-4 text-right">
    {!! Form::submit('Add Guest', ['class' => 'btn btn-success']) !!}
  </div>

  {!! Form::close() !!}

@endsection

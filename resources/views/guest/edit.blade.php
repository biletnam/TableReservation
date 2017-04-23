@extends('layouts.app')

@section('title', 'Guests - Edit')

@section('content')

  {!!  Form::model('App/Guest', [
    'url' => '/guests/' . $guest->id,
    'method' => 'put',
    'class' => 'form-horizontal'
    ]) !!}

    <div class="form-group ">
      <h3 class="col-sm-offset-4 col-sm-4">Edit Guest</h3>
    </div>

  <div class="form-group">
    {!! Form::label('id', 'ID', ['class'=> 'col-sm-4 control-label']) !!}

    <div class="col-sm-4">
        {!! Form::label('id', $guest->id, ['class'=> 'control-label']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('name', 'Guest Name', ['class'=> 'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
      {!! Form::text('name', $guest->name, ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('email', 'Email', ['class'=> 'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
      {!! Form::email('email', $guest->email, ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('phone', 'Phone', ['class'=> 'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
      {!! Form::tel('phone', $guest->phone, ['class' => 'form-control']) !!}
    </div>
  </div>

  <div class="col-sm-offset-4 col-sm-4 text-right">
    {!! Form::submit('Update Guest', ['class' => 'btn btn-success']) !!}
  </div>

  {!! Form::close() !!}

@endsection

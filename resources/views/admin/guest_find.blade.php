@extends('layouts.app')

@section('title', 'Guests - Find')

@section('content')


  {!!  Form::open( [
    'method' => 'get',
    'url' => '/guests/find/name',
    ]) !!}
  <div class="input-group col-xs-12 col-sm-8 col-sm-offset-2">
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    <span class="input-group-btn">
      {!! Form::submit('Find by Name', ['class' => 'btn btn-success']) !!}
    </span>
  </div>
  {!! Form::close() !!}
<hr  />
  {!!  Form::open( [
    'method' => 'get',
    'url' => '/guests/find/phone',
    ]) !!}
  <div class="input-group col-xs-12 col-sm-8 col-sm-offset-2">
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
    <span class="input-group-btn">
      {!! Form::submit('Find by Phone', ['class' => 'btn btn-success']) !!}
    </span>
  </div>
  {!! Form::close() !!}
<hr />
  {!!  Form::open( [
    'method' => 'get',
    'url' => '/guests/find/email',
    ]) !!}
  <div class="input-group col-xs-12 col-sm-8 col-sm-offset-2">
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
    <span class="input-group-btn">
      {!! Form::submit('Find by Email', ['class' => 'btn btn-success']) !!}
    </span>
  </div>
  {!! Form::close() !!}


@endsection

@extends('layouts.app')

@section('title', 'Tables')

@section('content')

  {!!  Form::model('App/Table', [
    'url' => '/tables/',
    'method' => 'post',
    'class' => 'form-horizontal'
    ]) !!}
    <div class="form-group ">
      <h3 class="col-sm-offset-4 col-sm-4">Add New Table</h3>
    </div>

  <div class="form-group">
    {!! Form::label('name', 'Table Name', ['class'=> 'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
      {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('seats', 'Max Seats', ['class'=> 'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
      {!! Form::number('seats', null, ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="col-sm-offset-4 col-sm-4 text-right">
    {!! Form::submit('Add Table', ['class' => 'btn btn-success']) !!}
  </div>

  {!! Form::close() !!}

@endsection

@extends('layouts.app')

@section('title', 'Roles - Add')

@section('content')

  {!!  Form::model('App/Roles', [
    'url' => '/roles/',
    'method' => 'post',
    'class' => 'form-horizontal'
    ]) !!}
    <div class="form-group ">
      <h3 class="col-sm-offset-4 col-sm-4">Add New Role</h3>
    </div>

  <div class="form-group">
    {!! Form::label('name', 'Role Name', ['class'=> 'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
      {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="col-sm-offset-4 col-sm-4 text-right">
    {!! Form::submit('Add Role', ['class' => 'btn btn-success']) !!}
  </div>

  {!! Form::close() !!}

@endsection

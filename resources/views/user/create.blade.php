@extends('layouts.app')

@section('title', 'Roles - Add')

@section('content')

  {!!  Form::model('App/User', [
    'url' => '/users/',
    'method' => 'post',
    'class' => 'form-horizontal'
    ]) !!}
    <div class="form-group ">
      <h3 class="col-sm-offset-4 col-sm-4">Add New User</h3>
    </div>

  <div class="form-group">
    {!! Form::label('name', 'Full Name', ['class'=> 'col-sm-4 control-label']) !!}
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
    {!! Form::label('role', 'Role', ['class'=> 'col-xs-12 col-sm-4 control-label']) !!}

    @foreach ($roles as $key => $role)
    <div class="col-xs-6 col-sm-8 control-group">

      {!! Form::checkbox('roles[]', $role->name, false, ['id'=>$role->name] ) !!}
      <span class="control-label ">
        {!! Form::label('roles[]', $role->name, ['for'=>$role->name] ) !!}
      </span>

    </div>
    @endforeach

  </div>
  <div class="col-sm-offset-4 col-sm-4 text-right">
    {!! Form::submit('Add User', ['class' => 'btn btn-success']) !!}
  </div>

  {!! Form::close() !!}

@endsection

@extends('layouts.app')

@section('title', 'User - Edit')

@section('content')

  {!!  Form::model('App/User', [
    'url' => '/users/' . $user->id,
    'method' => 'put',
    'class' => 'form-horizontal'
    ]) !!}

    <div class="form-group ">
      <h3 class="col-sm-offset-4 col-sm-4">Edit User</h3>
    </div>

  <div class="form-group">
    {!! Form::label('id', 'ID', ['class'=> 'col-sm-4 control-label']) !!}

    <div class="col-sm-4">
        {!! Form::label('id', $user->id, ['class'=> 'control-label']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('name', 'Full Name', ['class'=> 'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
      {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('email', 'Email', ['class'=> 'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
      {!! Form::label('email', $user->email, ['class' => 'control-label']) !!}
    </div>
  </div>
  <div class="form-group">
    <?php
      $rolesHeld = [];
      foreach ($user->roles as $role) {
        array_push($rolesHeld, $role->name);
      }
    ?>

    {!! Form::label('role', 'Role', ['class'=> 'col-xs-12 col-sm-4 control-label']) !!}

    @foreach ($roles as $role)
    <div class="col-xs-6 col-sm-8 control-group">
      <?php $checked = in_array($role->name, $rolesHeld); ?>
      {!! Form::checkbox('roles[]', $role->id, $checked, ['id'=>$role->name] ) !!}
      <span class="control-label ">
        {!! Form::label('roles[]', $role->name, ['for'=>$role->name] ) !!}
      </span>

    </div>
    @endforeach

  </div>
  <div class="form-group">
    {!! Form::label('active', 'Active', ['class'=> 'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
      {!! Form::select('active', [
        '1' => 'yes',
        '0' => 'no'
      ], $user->active, ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="col-sm-offset-4 col-sm-4 text-right">
    {!! Form::submit('Update User', ['class' => 'btn btn-success']) !!}
  </div>

  {!! Form::close() !!}

@endsection

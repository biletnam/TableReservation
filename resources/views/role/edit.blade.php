@extends('layouts.app')

@section('title', 'Roles - Edit')

@section('content')

  {!!  Form::model('App/Role', [
    'url' => '/roles/' . $role->id,
    'method' => 'put',
    'class' => 'form-horizontal'
    ]) !!}

    <div class="form-group ">
      <h3 class="col-sm-offset-4 col-sm-4">Edit Role</h3>
    </div>

  <div class="form-group">
    {!! Form::label('id', 'ID', ['class'=> 'col-sm-4 control-label']) !!}

    <div class="col-sm-4">
        {!! Form::label('id', $role->id, ['class'=> 'control-label']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('name', 'Role Name', ['class'=> 'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
      {!! Form::text('name', $role->name, ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="col-sm-offset-4 col-sm-4 text-right">
    {!! Form::submit('Update Role', ['class' => 'btn btn-success']) !!}
  </div>

  {!! Form::close() !!}

@endsection

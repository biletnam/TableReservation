@extends('layouts.app')

@section('title', 'Tables')

@section('content')

  {!!  Form::model('App/Table', [
    'url' => '/tables/' . $table->id,
    'method' => 'put',
    'class' => 'form-horizontal'
    ]) !!}

    <div class="form-group ">
      <h3 class="col-sm-offset-4 col-sm-4">Edit Table</h3>
    </div>

  <div class="form-group">
    {!! Form::label('id', 'ID', ['class'=> 'col-sm-4 control-label']) !!}

    <div class="col-sm-4">
        {!! Form::label('id', $table->id, ['class'=> 'control-label']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('name', 'Table Name', ['class'=> 'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
      {!! Form::text('name', $table->name, ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('seats', 'Max Seats', ['class'=> 'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
      {!! Form::number('seats', $table->seats, ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="col-sm-offset-4 col-sm-4 text-right">
    {!! Form::submit('Update Table', ['class' => 'btn btn-success']) !!}
  </div>

  {!! Form::close() !!}

@endsection

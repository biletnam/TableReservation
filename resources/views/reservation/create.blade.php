@extends('layouts.app')

@section('title', 'Reservation - Add')

@section('content')

  {!!  Form::model('App/Reservation', [
    'url' => '/reservations/',
    'method' => 'post',
    'class' => 'form-horizontal'
    ]) !!}
    <div class="form-group ">
      <h3 class="col-sm-offset-4 col-sm-4">Add New Reservation</h3>
    </div>
    <div class="form-group">
      {!! Form::hidden('table_id', $tableId) !!}
      {!! Form::label('table_id', 'Table ID: ', ['class'=> 'col-xs-4 control-label']) !!}
      <div class="col-xs-4">
          {!! Form::label('table_id', $tableId, ['class'=> 'control-label']) !!}
      </div>
    </div>

    <div class="form-group">
      {!! Form::hidden('party', $party) !!}
      {!! Form::label('party', 'Party Size: ', ['class'=> 'col-xs-4 control-label']) !!}
      <div class="col-xs-4">
          {!! Form::label('party', $party, ['class'=> 'control-label']) !!}
      </div>
    </div>

    <div class="form-group">
      {!! Form::hidden('date', $start_time->format('Y-m-d')) !!}
      {!! Form::label('date', 'Date: ', ['class'=> 'col-xs-4 control-label']) !!}
      <div class="col-xs-4">
          {!! Form::label('date', $start_time->format('l, M d, Y'), ['class'=> 'control-label']) !!}
      </div>
    </div>

    <div class="form-group">
      {!! Form::hidden('start_time', $start_time->format('Y-m-d H:i:s')) !!}
      {!! Form::label('start_time', 'Start Time: ', ['class'=> 'col-xs-4 control-label']) !!}
      <div class="col-xs-4">
          {!! Form::label('start_time', $start_time->format('h:ia'), ['class'=> 'control-label']) !!}
      </div>
    </div>
    <div class="form-group">
      {!! Form::label('end_time', 'End Time: ', ['class'=> 'col-xs-4 control-label']) !!}
      <div class="col-sm-4">
          {!! Form::text('end_time', $end_time->format('h:ia'), ['class'=> 'form-control']) !!}
      </div>
    </div>





  <div class="form-group">
    {!! Form::label('customer_name', 'Customer Name', ['class'=> 'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
      {!! Form::text('customer_name', null, ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('customer_phone', 'Customer Phone', ['class'=> 'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
      {!! Form::tel('customer_phone', null, ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('customer_email', 'Customer Email', ['class'=> 'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
      {!! Form::email('customer_email', null, ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="col-sm-offset-4 col-sm-4 text-right">
    {!! Form::submit('Add Reservation', ['class' => 'btn btn-success']) !!}
  </div>

  {!! Form::close() !!}

@endsection

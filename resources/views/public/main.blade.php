@extends('layouts.public')

@section('title', 'Reservations')

@section('head')
  <link rel="stylesheet" href="/css/jquery-ui.min.css">
@endsection

@section('content')

  <?php $date_f = (isset($_GET['date'])? date_create($_GET['date'])->format('m/d/Y') : null)?>

  <h2 class="col-xs-offset-4 col-xs-8">Reservations</h2>
  {!!  Form::open( [
    'method' => 'get',
    'url' => '/find',
    'class' => 'form-horizontal'
    ]) !!}

  <div class="form-group">
    {!! Form::label('datepicker', 'Date:', ['class'=> 'col-xs-4 control-label']) !!}
    <div class="col-xs-8 col-sm-4">
      {!! Form::text('date', $date_f, ['class' => 'form-control', 'id'=>'datepicker']) !!}
    </div>
  </div>
  <div class="form-group">

    {!! Form::label('party', 'Party Size:', ['class'=> 'col-xs-4 control-label']) !!}
    <div class="col-xs-8  col-sm-4">
      {!! Form::number('party', (isset($_GET['party'])? $_GET['party'] : null), ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="form-group">
    <span class="col-xs-offset-4 col-xs-8">
      {!! Form::submit('Find Available Times', ['class' => 'btn btn-success']) !!}
    </span>
  </div>
  {!! Form::close() !!}


  @if(isset($time_slots))
  <hr />
    {!!  Form::open( [
      'method' => 'get',
      'url' => '/reserve',
      'class' => 'form-horizontal'
      ]) !!}


    {!! Form::hidden('party_size', $_GET['party']) !!}
    {!! Form::hidden('date', $_GET['date']) !!}
    {!! Form::hidden('table_id',null, ['id'=>'table_id']) !!}
    {!! Form::hidden('time',null, ['id'=>'time']) !!}

      <div class="form-group">

        {!! Form::label('time', 'Reservation Time:', ['class'=> 'col-xs-4 control-label']) !!}
        <div class="col-xs-8 col-sm-4">
          <select class="form-control" onchange="updateHiddenValues(this.value)" required>
            <option value=""></option>
            @for($i=0; $i < sizeof($time_slots); $i++)
            <option value="{{$time_slots[$i][1]}}-{{date_create($time_slots[$i][0])->format('g:ia')}}">
              {{date_create($time_slots[$i][0])->format('g:ia')}}
            </option>
            @endfor
          </select>
        </div>
      </div>
      <div class="form-group">
        {!! Form::label('fullname', 'Name:', ['class'=> 'col-xs-4 control-label']) !!}
        <div class="col-xs-8 col-sm-4">
          {!! Form::text('fullname', null, ['class' => 'form-control','required' => 'required']) !!}
        </div>
        <div class="col-sm-8"></div>
      </div>
      <div class="form-group">
        {!! Form::label('email', 'Email:', ['class'=> 'col-xs-4 control-label']) !!}
        <div class="col-xs-8 col-sm-4">
          {!! Form::email('email', null, ['class' => 'form-control']) !!}
        </div>
        <div class="col-sm-8"></div>
      </div>
      <div class="form-group">
        {!! Form::label('phone', 'Telephone:', ['class'=> 'col-xs-4 control-label']) !!}
        <div class="col-xs-8 col-sm-4">
          {!! Form::text('phone', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="col-sm-8"></div>
      </div>

    <div class="form-group">
      <span class="col-xs-offset-4 col-xs-8">
        {!! Form::submit('Make Reservation Request', ['class' => 'btn btn-success']) !!}
      </span>
    </div>
    {!! Form::close() !!}
    <!-- var_dump("<pre>", $time_slots, "</pre>"); -->
  @endif

@endsection

@section('scripts')
<script src="/js/jquery-ui.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
});
function updateHiddenValues(value){
  var split = value.split('-');
  var tableId = split[0];
  var time = split[1];

  document.getElementById("time").value = time;
  document.getElementById("table_id").value = tableId;
}
</script>
@endsection

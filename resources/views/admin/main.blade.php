@extends('layouts.app')

@section('title', 'Reservations')

@section('content')

<div class='col-xs-6 col-sm-8 col-md-6 '>
  <div class="panel panel-success">
    <div class="panel-heading">
      <span>Reservations</span>
    </div>
    <table class="table">
      <tr>
        <th>Status</th>
        <th>Total</th>
      </tr>
      <tr>
        <td>Requested</td>
        <td>
          <?php $requested = (isset($status['requested']))?$status['requested']:0 ?>
          @if( $requested > 0)
          <button class="btn btn-warning" type="button">
            {{$requested = isset($status['requested'])?$status['requested']:0}}
            <span class="glyphicon glyphicon-alert"></span>
          </button>
          @else
          0
          @endif
        </td>
      </tr>
      <tr>
        <td>Confirmed</td>
        <td>{{isset($status['confirmed'])?$status['confirmed']:0}}</td>
      </tr>
      <tr>
        <td>Seated</td>
        <td>{{isset($status['seated'])?$status['seated']:0}}</td>
      </tr>
      <tr>
        <td>Released</td>
        <td>{{isset($status['released'])?$status['released']:0}}</td>
      </tr>

    </table>
  </div>
</div>

@endsection

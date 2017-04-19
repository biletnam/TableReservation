@extends('layouts.app')

@section('title', 'Hours')

@section('content')

  <div class="panel panel-success">
    <div class="panel-heading">
      <span>Hours</span>
      <span class='pull-right'><a href="/hours/create">New Hours</a></span>
    </div>
    <table class="table">
      <tr>

        <th>Day</th>
        <th>Open</th>
        <th>Close</th>
        <th></th>
      </tr>
    @foreach ($hours as $hour)
      <tr>

        <td>
          <a href="/hours/{{$hour->id}}">
            {{$days[$hour->day]}}
          </a>
        </td>
        @if($hour->opened)
        <td>{{ date_format(new DateTime($hour->open),'h:ia') }}</td>
        <td>{{ date_format(new DateTime($hour->close),'h:ia') }}</td>
        @else
          <td></td>
          <td></td>
        @endif
        <td>
          <button class="btn btn-xs btn-default">
          <a href="/hours/{{$hour->id}}/edit">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
          </a>
          </button>
        </td>
        <!-- <td>

          {!!  Form::model($hour, [
            'url' => '/hours/' . $hour->id,
            'method' => 'delete',
            'style' => 'display: inline-block'
            ]) !!}
            <button type="submit" class="btn btn-xs btn-danger">
              <span class="glyphicon glyphicon-remove" aria-hidden="true"/></span>
            </button>
          {!! Form::close() !!}

        </td> -->
      </tr>
    @endforeach
    </table>
  </div>

@endsection

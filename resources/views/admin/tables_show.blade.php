@extends('layouts.app')

@section('title', 'Tables')

@section('content')

  <div class="panel panel-success">
    <div class="panel-heading">
      <span>Tables</span>
      <span class='pull-right'><a href="/tables/create">New Table</a></span>
    </div>
    <table class="table">
      <tr>

        <th>Name</th>
        <th>Max Seats</th>
        <th></th>
      </tr>
    @foreach ($tables as $table)
      <tr>

        <td>{{$table->name}}</td>
        <td>{{$table->seats}}</td>
        <td>
          <button class="btn btn-xs btn-default">
          <a href="/tables/{{$table->id}}/edit">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
          </a>
          </button>
        </td>
        <td>

          {!!  Form::model($table, [
            'url' => '/tables/' . $table->id,
            'method' => 'delete',
            'style' => 'display: inline-block'
            ]) !!}
            <button type="submit" class="btn btn-xs btn-danger">
              <span class="glyphicon glyphicon-remove" aria-hidden="true"/></span>
            </button>
          {!! Form::close() !!}

        </td>
      </tr>
    @endforeach
    </table>
  </div>

@endsection

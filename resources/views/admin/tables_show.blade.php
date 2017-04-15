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
          <a href="/tables/{{$table->id}}/edit">Edit</a> |

          {!!  Form::model($table, [
            'url' => '/tables/' . $table->id,
            'method' => 'delete'
            ]) !!}
            {!! Form::submit('Delete'); !!}
          {!! Form::close() !!}

        </td>
      </tr>
    @endforeach
    </table>
  </div>

@endsection

@extends('layouts.app')

@section('title', 'Tables')

@section('content')
  <div class="panel panel-info">
    <div class="panel-heading">Tables</div>
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
        <td><a href="">Edit</a> | <a href="">Delete</a></td>
      </tr>
    @endforeach
    </table>
  </div>

@endsection

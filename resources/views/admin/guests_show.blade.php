@extends('layouts.app')

@section('title', 'Guests')

@section('content')

  <div class="panel panel-success">
    <div class="panel-heading">
      <span>Guests</span>
      <span class='pull-right'><a href="/guests/create">New Guest</a></span>
    </div>
    <table class="table">
      <tr>

        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    @foreach ($guests as $guest)
      <tr>

        <td>
          <a href="/guests/{{$guest->id}}">
            {{$guest->name}}
          </a>
        </td>
        <td>{{$guest->phone}}</td>
        <td>{{$guest->email}}</td>
        <td>
          <button class="btn btn-xs btn-default">
          <a href="/guests/{{$guest->id}}/edit">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
          </a>
          </button>
        </td>
        <td>

          {!!  Form::model($guest, [
            'url' => '/guests/' . $guest->id,
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

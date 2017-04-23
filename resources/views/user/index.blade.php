@extends('layouts.app')

@section('title', 'Users')

@section('content')

  <div class="panel panel-success">
    <div class="panel-heading">
      <span>Users</span>
      <span class='pull-right'><a href="/users/create">New Users</a></span>
    </div>
    <table class="table">
      <tr>

        <th>Name</th>
        <th>Email</th>
        <th>Active</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    @foreach ($users as $user)
      <tr>

        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>@if($user->active)
          Y
          @else
          N
          @endif
        </td>
        <td>
          <button class="btn btn-xs btn-default">
          <a href="/users/{{$user->id}}/edit">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
          </a>
          </button>
        </td>
        <td>

          {!!  Form::model($user, [
            'url' => '/users/' . $user->id,
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

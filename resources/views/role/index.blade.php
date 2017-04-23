@extends('layouts.app')

@section('title', 'Roles')

@section('content')

  <div class="panel panel-success">
    <div class="panel-heading">
      <span>Roles</span>
      <span class='pull-right'><a href="/roles/create">New Role</a></span>
    </div>
    <table class="table">
      <tr>

        <th>Name</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    @foreach ($roles as $role)
      <tr>

        <td>
          <a href="/roles/{{$role->id}}">
            {{$role->name}}
          </a>
        </td>
        <td>
          <button class="btn btn-xs btn-default">
          <a href="/roles/{{$role->id}}/edit">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
          </a>
          </button>
        </td>
        <td>

          {!!  Form::model($role, [
            'url' => '/roles/' . $role->id,
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

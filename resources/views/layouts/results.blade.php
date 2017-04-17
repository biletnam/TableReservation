@extends('layouts.app')

@section('title', 'Results')

@section('content')

<div class='container'>


  @if($status == 'error')
  <div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span>
    {{ $msg }}
  </div>
  <div class='text-center'>
    <button onclick="history.back()" class="btn btn-default">Back</button>
    <a href="{{ $redirect }}" class='btn btn-default'>Cancel</a>
  </div>
  @elseif ($status == 'success')
  <div class="alert alert-success" role="alert">
    <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
    <span class="sr-only">Success:</span>
    {{ $msg }}
  </div>
  <div class='text-center'>
    <a href="{{ $redirect }}" class='btn btn-success'>Home</a>
  </div>
  @elseif ($status == 'warning')
  <div class="alert alert-warning" role="alert">
    <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
    <span class="sr-only">Warning:</span>
    {{ $msg }}
  </div>
  <div class='text-center'>
    <a href="{{ $redirect }}" class='btn btn-warning'>OK</a>
  </div>
  @endif

<!-- end of messages -->
</div>


@endsection

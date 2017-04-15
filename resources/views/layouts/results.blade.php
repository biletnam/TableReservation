@extends('layouts.app')

@section('title', 'Results')

@section('content')

<div class='container'>


  <?php if($status == 'error') {  ?>
  <div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span>
    {{ $msg }}
  </div>
  <button onclick="history.back()" class="btn btn-default">Back</button>
  <a href="{{ $redirect }}" class='btn btn-default pull-right'>Cancel</a>
  <?php } else if ($status == 'success'){ ?>
  <div class="alert alert-success" role="alert">
    <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
    <span class="sr-only">Success:</span>
    {{ $msg }}
  </div>
  <a href="{{ $redirect }}" class='btn btn-success pull-right'>Home</a>
  <?php } else if ($status == 'warning'){ ?>
  <div class="alert alert-warning" role="alert">
    <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
    <span class="sr-only">Warning:</span>
    {{ $msg }}
  </div>
  <a href="{{ $redirect }}" class='btn btn-success pull-right'>Home</a>
  <?php } ?>

<!-- end of messages -->
</div>


@endsection

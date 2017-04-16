@extends('layouts.app')

@section('title', $title . ' - Show')

@section('content')

<h3>{{$title}}</h3>
<table class='table'>
  <?php foreach ($model['attributes'] as $key => $value): ?>
    <tr>
      <th>
        {{ $key }}
      </th>
      <td>
        {{ $value }}
      </td>
    </tr>
  <?php endforeach; ?>
</table>


<button onclick="history.back()" class="btn btn-default">Back</button>


@endsection

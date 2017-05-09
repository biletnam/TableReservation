<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Reservations - @yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/css/app.css" rel="stylesheet">
    @yield('head')
  </head>
  <body>


    <div class="container">
      @section('sidebar')
          <!-- This is the master sidebar. -->
      @show

      @yield('content')

    </div>


  <script src="/js/app.js"></script>
  @yield('scripts')
  </body>
</html>

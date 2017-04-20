<!-- Static navbar -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/admin">Table Reservations</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <!-- <li class="active"><a href="#">Home</a></li> -->
        @if (Auth::check())
        <li><a href="/tables">Tables</a></li>
        <!-- <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tables <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/tables">View</a></li>
              <li><a href="/tables/create">Add Table</a></li>
            </ul>
        </li> -->

        <!-- <li><a href="/reservations">Reservations</a></li> -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reservations <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/reservations/calendar">View All</a></li>
              <li><a href="/reservations/date/{{ date_format(new DateTime, 'Y-m-d')}}">Today's Reservations</a></li>
              <li><a href="/reservations/create/selectDate">Add Reservation</a></li>
            </ul>
        </li>
        <!-- <li><a href="/guests">Guests</a></li> -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Guests <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/guests">View All</a></li>
              <li><a href="/guests/create">Add Guest</a></li>
              <li><a href="/guests/find">Search</a></li>
            </ul>
        </li>
        <li><a href="/hours">Hours</a></li>
        <li>
          {!! Form::open(['method' => 'POST', 'route' => 'logout']) !!}
          <button type="submit" class="btn " style="border:0;background-color:white;padding-top:14px;">Logout</button>
          {!! Form::close() !!}
        </li>
        @else
            <li><a href="{{ url('/login') }}">Login</a></li>
            <li><a href="{{ url('/register') }}">Register</a></li>
        @endif

      </ul>
    </div><!--/.nav-collapse -->
  </div><!--/.container-fluid -->
</nav>

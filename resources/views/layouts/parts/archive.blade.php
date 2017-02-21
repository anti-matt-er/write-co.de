<nav>
  <h1>Archive</h1>
  @foreach ($dates as $date => $r_date)
      <a href="{{ url("/date/$date") }}">{{ $r_date }}</a>
  @endforeach
</nav>

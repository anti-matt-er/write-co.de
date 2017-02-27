<nav>
  <h2>Archive</h2>
  @foreach ($dates as $date => $r_date)
      <a href="{{ url("/date/$date") }}">{{ $r_date }}</a>
  @endforeach
</nav>

<nav>
  <a href="{{ url('/dashboard') }}">
    <button data-wc-button="Home"></button>
  </a>
  @include('layouts.parts.admin.nav', [
    'showCounters' => false
  ])
</nav>

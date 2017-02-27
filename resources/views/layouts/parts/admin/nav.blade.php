<a href="{{ url('/dashboard/articles') }}">
  <button data-wc-button="Articles">
    @if ($showCounters)
      {!!$counters['pendingPosts'] ? "<aside class\"counter\">$counters[pendingPosts]</aside>" : ''!!}
    @endif
  </button>
</a>
<a href="{{ url('/dashboard/media') }}">
  <button data-wc-button="Media"></button>
</a>
<a href="{{ url('/dashboard/comments') }}">
  <button data-wc-button="Comments">
    @if ($showCounters)
      {!!$counters['pendingComments'] ? "<aside class=\"counter\">$counters[pendingComments]</aside>" : ''!!}
    @endif
  </button>
</a>
<a href="{{ url('/dashboard/config') }}">
  <button data-wc-button="Config"></button>
</a>
<a href="{{ url('/dashboard/tools') }}">
  <button data-wc-button="Tools"></button>
</a>
<a href="{{ url('/dashboard/write') }}">
  <button data-wc-button="Write"></button>
</a>

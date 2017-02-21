<div class="left-wrapper">
  <div class="about">
    <h1>Matthew Burrows</h1>
    <img src="http://placehold.it/120" alt="A picture of Matthew Burrows">
    <p>A pedantic Brit with a penchant for web technology, music, and stupid things.</p>
  </div>
  <aside class="tags">
    <h3>Frequent Tags</h3>
    <ul>
    @foreach ($topTags as $tag)
      <li>
        <a href="/tag/{{ $tag->tag_id }}">{{ $tag->tag }}</a> <sub>&times;{{$tag->tag_count}}</sub>
      </li>
    @endforeach
    </ul>
  </aside>
</div>

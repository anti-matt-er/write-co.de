@extends('layouts.public')

@section('title', $title)

@section('content')
  @if (strtolower($title) != 'home')
    <h1>{{ $title }}</h1>
  @endif
  @foreach ($posts as $post)
    <article>
      <h1><a href="/post/{{ $post->slug }}" class="unstyled">{{ $post->title }}</a></h1>
      @if (count($post->tags))
      <aside class="tags">
          @foreach ($post->tags as $tag)
            <a href="/tag/{{ $tag->id }}">{{ $tag->tag }}</a>
          @endforeach
      </aside>
      @endif
      <p>
        {!! str_limit($post->content, 500) !!}
      </p>
      <a href="/post/{{ $post->slug }}" class="read-more">Read more</a>
      <div class="post-info">
        <a href="/user/{{ $post->user->id }}" rel="author">{{ $post->user->name }}</a> on
        <time datetime="{{ $post->published_at->format('Y-m-d') }}" class="bar-time">{{ $post->published_at->format('M jS Y g:ia') }}</time>
      </div>
    </article>
  @endforeach
  <h3>Page {{ $posts->currentPage() }} of {{ $posts->lastPage() }}</h3>
  {!! $posts->render() !!}
@endsection

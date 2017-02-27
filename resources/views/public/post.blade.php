@extends('layouts.public')

@section('title', $post->title)

@section('content')
    <article class="post">
      <h1>{{ $post->title }}</h1>
      @if (count($post->tags))
      <aside class="tags">
          @foreach ($post->tags as $tag)
            <a href="/tag/{{ $tag->id }}">{{ $tag->tag }}</a>
          @endforeach
      </aside>
      @endif
      <p>
        {!! $post->content !!}
      </p>
      <div class="post-info">
        <a href="/user/{{ $post->user->id }}" rel="author">{{ $post->user->name }}</a> on
        <time datetime="{{ $post->published_at->format('Y-m-d') }}" class="bar-time">{{ $post->published_at->format('M jS Y g:ia') }}</time>
      </div>
    </article>
@endsection

@section('comments')
    <aside class="comments">
        <h2>Comments</h2>
        @if (count($post->comments))
            @include('layouts.parts.comment', [
              'comments' => $post->comments,
              'depth' => 1,
              'stripe' => false,
            ])
        @else
            <em>There are no comments yet, why not start the discussion?</em>
        @endif
        @include('layouts.parts.add-comment', ['post_id' => $post->id])
    </aside>
@endsection

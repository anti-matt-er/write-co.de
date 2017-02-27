@extends('layouts.admin')

@section('title', $title)

@section('content')
  <h1>@yield('title')</h1>
  <nav class="filter">
    @if (!Request::is('dashboard/comments/all'))
      <a href="{{ url('dashboard/comments/all') }}">View all comments</a>
    @endif
    @if (!Request::is('dashboard/comments'))
      <a href="{{ url('dashboard/comments') }}">View unapproved comments</a>
    @endif
    @if (!Request::is('dashboard/comments/deleted'))
      <a href="{{ url('dashboard/comments/deleted') }}">View deleted comments</a>
    @endif
    <form action="{{ url('dashboard/comments/filter') }}" method="get">
        {{ csrf_field() }}
        <select name="field">
          <option disabled="disabled" selected="selected">--FILTER--</option>
          <option value="id">Comment ID</option>
          <option value="name">Comment Name</option>
          <option value="content">Comment Content</option>
          <option value="post_id">Post ID</option>
          <option value="prompt_id">Prompt ID</option>
        </select>
        <input type="text" name="value" />
        <input type="submit" value="Go" />
    </form>
  </nav>
  @if (count($comments))
    <h3>Page {{ $comments->currentPage() }} of {{ $comments->lastPage() }}</h3>
    {!! $comments->render() !!}
    @foreach($comments as $comment)
      <article>
        <div class="header">
          <strong>#{{ $comment->id }}</strong>
          <span>{{ $comment->name }}</span>
        </div>
        <div>
          <strong>Content</strong>
          <span>{{ $comment->content }}</span>
        </div>
        <div>
          <strong>Article</strong>
          <span>Post #{{ $comment->post->id }} <a href="/post/{{ $comment->post->slug }}">{{ $comment->post->title }}</a></span>
        </div>
        <div>
          <strong>In reply to</strong>
          <span>
            @if (count($comment->prompt))
              Comment #{{ $comment->prompt->id }} ({{ '@'.$comment->prompt->name }})
            @else
              N/A
            @endif
          </span>
        </div>
        <div>
          <strong>Date Submitted</strong>
          <span>{{ $comment->created_at->format('Y-m-d H:i:s') }}</span>
        </div>
        <form action="{{ url('/dashboard/comments/') }}" method="post">
          <span>
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PATCH" />
            <input type="hidden" name="id" value="{{ $comment->id }}" />
          </span>
          <span>
            @if (!$comment->trashed())
              <button name="_method" value="DELETE">Delete</button>
              @if (is_null($comment->published_at))
                <button name="action" value="approve">Approve</button>
              @else
                <button name="action" value="unpublish">Unpublish</button>
              @endif
            @else
              <button name="action" value="restore">Restore</button>
            @endif
          </span>
        </form>
      </article>
    @endforeach
    <h3>Page {{ $comments->currentPage() }} of {{ $comments->lastPage() }}</h3>
    {!! $comments->render() !!}
  @else
    No results.
  @endif
@endsection

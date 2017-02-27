@foreach ($comments as $comment)
  @if (!isset($comment->reply_to) || (isset($prompt_id) && $comment->reply_to == $prompt_id))
    <article class="comment{{($depth >= config('blog.max_comment_depth')) ? ' deep' : ''}}{{$stripe ? ' stripe' : ''}}">
      <h2>{{$comment->name}}</h2>
      <div class="content">
        @if (!is_null($comment->prompt))
            <a href="#reply-{{$comment->prompt->id}}">{{'@' . $comment->prompt->name}}</a>
        @endif
        {{$comment->content}}
      </div>
      <aside>
        <span class="info">
          {{$comment->created_at->format('Y-m-d H:i')}}
        </span>
        <input type="checkbox" id="reply-{{$comment->id}}" />
        <label for="reply-{{$comment->id}}"></label>
        @include('layouts.parts.add-comment', [
          'post_id' => $post->id,
          'prompt' => $comment
        ])
      </aside>
      @if (count($comment->replies) && $depth < config('blog.max_comment_depth'))
          @include('layouts.parts.comment', [
              'comments' => $comment->replies,
              'prompt_id' => $comment->id,
              'depth' => $depth + 1,
              'stripe' => !$stripe,
          ])
      @endif
    </article>
    @if (count($comment->replies) && $depth >= config('blog.max_comment_depth'))
        @include('layouts.parts.comment', [
            'comments' => $comment->replies,
            'prompt_id' => $comment->id,
            'depth' => $depth + 1,
            'stripe' => !$stripe,
        ])
    @endif
  @endif
@endforeach

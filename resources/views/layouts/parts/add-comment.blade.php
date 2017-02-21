<form action="{{ url('/postcomment') }}" method="post" class="add-comment">
    {{ csrf_field() }}
    <input type="hidden" name="post_id" value="{{$post_id}}" />
    @if (isset($prompt))
      <input type="hidden" name="prompt_id" value="{{$prompt->id}}" />
    @endif
    <label>
        Display Name
        <input type="text" name="name" />
    </label>
    <label>
        Comment
        <textarea name="content"></textarea>
    </label>
    @if (isset($prompt))
      <input type="submit" value="Leave reply" />
    @else
      <input type="submit" value="Leave comment" />
    @endif
</form>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="notice danger">
            {{ $error }}
        </div>
    @endforeach
@endif
@if (isset($notices))
    @foreach ($notices as $notice)
        <div class="notice {{ $notice['type'] }}">
            {{ $notice['message'] }}
        </div>
    @endforeach
@endif

@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
  <h1>@yield('title')</h1>
  <nav class="tiles">
    @include('layouts.parts.admin.nav', [
      'showCounters' => true
    ])
  </nav>
  <aside class="notifications">
    @foreach ($notifications as $type => $messages)
      @foreach ($messages as $message)
        @include('layouts.parts.admin.notification', [
          'type' => $type,
          'message' => $message
        ])
      @endforeach
    @endforeach
  <aside>
@endsection

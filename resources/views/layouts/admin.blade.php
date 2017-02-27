<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link href="{{ mix('/css/dashboard.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <aside>
          @include('layouts.parts.admin.left')
        </aside>
        <main>
          @yield('content')
        </main>
    </body>
</html>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>@yield('title') - I write-co.de</title>
  <link href="{{ mix('/css/public.css') }}" rel="stylesheet" type="text/css">
	<!--[if lt IE 9]>
	  <script>
	    document.createElement('header');
	    document.createElement('nav');
	    document.createElement('section');
	    document.createElement('article');
	    document.createElement('aside');
	    document.createElement('footer');
	    document.createElement('hgroup');
	  </script>
	<![endif]-->
</head>
<body>
	<header>
		@include('layouts.parts.header')
	</header>
	<div class="wrapper">
		<aside>
			@include('layouts.parts.left')
		</aside>
		<main>
      @yield('content')
			@yield('comments')
		</main>
		<aside>
			@include('layouts.parts.archive')
		</aside>
	</div>
</body>
</html>

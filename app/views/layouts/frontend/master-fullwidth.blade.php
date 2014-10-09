<!doctype html>
<html lang="en">
	<head>
		<title>
			@yield('title', 'Digital Handyman')
		</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Digital Handyman">
		@yield('meta')
		<link rel="shortcut icon" href="{{ asset('favicon.png') }}"/>
		<link rel="stylesheet" href="{{ asset('/css/styles.css') }}">
		@yield('styles')
		<link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
		<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
	</head>
	<body>
		@include('layouts.frontend.header')

		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					@yield('content')
				</div>
			</div>
		</div>

		@include('layouts.frontend.footer')

		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-55080226-1', 'auto');
		  ga('send', 'pageview');

		</script>
		@yield('scripts')   
	</body>
</html>
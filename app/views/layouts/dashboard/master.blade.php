<!DOCTYPE html>
<html lang="en">
	<head>
		<title>
			@yield('title', 'Digital Handyman Dashboard')
		</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Digital Handyman">
		@yield('metaDescription', '<meta name="description" content="Digital Handyman provides computer repair services Nation wide.">')
		@yield('metaKeywords', '<meta name="description" content="computer repair, computer repair services, computer servicing">')
		<link rel="shortcut icon" href="{{ asset('favicon.png') }}"/>
		<!--<link rel="stylesheet" href="{{ asset('/css/styles.css') }}">-->
		<link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
		<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
		<link href="{{ asset('/css/summernote.css') }}" rel="stylesheet">
		@yield('styles')
	</head>
	<body>
		@include('layouts.dashboard.header')

		<div class="container">
			<div class="row">
					@yield('content')
			</div>
		</div>

		@include('layouts.dashboard.footer')

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
		<script src="{{ asset('/js/summernote.min.js') }}"></script>
		<script type="text/javascript">
			$(document).ready(function() {

				 $('.summernote').summernote({
				 	height: "500px",
				 	toolbar: [
						['style', ['style', 'bold', 'italic', 'underline', 'clear', 'strikethrough']],
						['para', ['ul', 'ol', 'paragraph']],
						['insert', ['picture', 'link', 'video', 'table', 'hr']],
						['misc', ['fullscreen', 'codeview']]
					]
				 });

				 //window.setTimeout(function() { $(".alert").alert('close'); }, 2500);

			});
		</script>
		@yield('scripts')   
	</body>
</html>
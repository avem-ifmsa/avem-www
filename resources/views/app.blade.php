<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>{{ $title }}</title>

		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
		@stack('fonts')

		<!-- Styles -->
		<link type="stylesheet" href=" {{ asset('css/app.css') }}">
		@stack('stylesheets')

		<!-- Scripts -->
		<script src="{{ asset('js/app.js') }}"></script>
		@stack('scripts')
	</head>

	<body>
		<div id="avem-es">
			@yield('content')
		</div>
	</body>
</html>

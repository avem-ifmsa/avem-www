<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>@yield('title')</title>

		<link rel="stylesheet" href="{{ elixir('css/app.css') }}">
		@stack('styles')
	</head>

	<body id="avem_es">
		<div class="container">
			@yield('content')
		</div>

		<script src="{{ elixir('js/vendor.js') }}"></script>
		<script src="{{ elixir('js/app.js') }}"></script>
		@stack('scripts')
	</body>
</html>

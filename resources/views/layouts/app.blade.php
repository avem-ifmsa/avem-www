<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Favicon Tags -->
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
		<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="/manifest.json">
		<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#999999">
		<meta name="theme-color" content="#ffffff">

		<!-- OpenGraph Protocol -->
		<meta property="og:type" content="website">
		<meta property="og:locale" content="es_ES">
		<meta property="og:url" content="{{ url('/') }}">
		<meta property="og:title" content="Web oficial de AVEM">
		<meta property="og:image" content="{{ asset('img/avem-logo.png') }}">
		<meta property="og:description" content="Web oficial de la Asociación Valenciana de Estudiantes de Medicina.">
		<meta name="description" content="Web oficial de la Asociación Valenciana de Estudiantes de Medicina.">

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<script>
			window.Laravel = {!! json_encode([
				'csrfToken' => csrf_token(),
			]) !!};
		</script>

		<title>Web oficial de AVEM</title>

		<!-- Styles -->
		<link href="{{ mix('css/app.css') }}" rel="stylesheet">
		@stack('styles')

		<!-- Scripts -->
		<script src="{{ mix('js/app.js') }}"></script>
		@stack('scripts')
	</head>

	@yield('body')
</html>

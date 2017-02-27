@extends('layouts.app')

@section('body')
	<body class="admin">
		<div id="app">
			<div class="container">
				<div class="mt-5 mb-2 text-center">
					<img src="{{ asset('img/avem-logo.svg')}}">
				</div>

				@yield('content')
			</div>
		</div>
	</body>
@stop

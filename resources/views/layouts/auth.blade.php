@extends('layouts.app')

@section('body')
	<body class="main">
		<div id="app">
			<div class="page-header">
				<a class="header-icon" href="{{ url('/') }}">
					{!! file_get_contents('img/avem-logo.svg') !!}
				</a>
			</div>

			<div class="container">
				@yield('content')
			</div>
		</div>
	</body>
@stop

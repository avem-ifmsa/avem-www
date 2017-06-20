@extends('layouts.app')

@section('body')
	<body class="admin">
		<div id="app">
			<div class="container">
				<div class="mt-5 mb-4 text-center avem-icon">
					{!! file_get_contents('img/avem-logo.svg') !!}
				</div>

				@yield('content')
			</div>
		</div>
	</body>
@stop

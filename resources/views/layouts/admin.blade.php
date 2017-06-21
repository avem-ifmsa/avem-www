@extends('layouts.app')

@section('body')
	<body class="admin">
		<div id="app">
			<div class="section-header">
				<a class="header-icon" href="{{ route('admin.index') }}">
					{!! file_get_contents('img/avem-logo.svg') !!}
				</a>

				@hasSection('section-title')
					<h1 class="header-title">
						@yield('section-title')
					</h1>
				@endif
			</div>

			@yield('content')
		</div>
	</body>
@stop

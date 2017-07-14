@extends('layouts.app')

@section('body')
	<body class="main">
		<div id="app">
			<div class="page-header">
				<a class="header-icon" href="{{ route('admin.index') }}">
					{!! file_get_contents('img/avem-logo.svg') !!}
				</a>

				@hasSection('section-title')
					<h1 class="header-title">
						@yield('section-title')
					</h1>
				@endif
			</div>

			<div class="container">
				@yield('content')
			</div>
		</div>
	</body>
@stop

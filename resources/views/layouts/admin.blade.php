@extends('layouts.app')

@section('body')
	<body class="admin">
		<div id="app">
			<div class="container">
				<div class="section-header">
					<a class="header-icon" href="{{ route('admin.index') }}">
						{!! file_get_contents('img/avem-logo.svg') !!}
					</a>
					<h1 class="header-title">Panel de administración</h1>
				</div>

				@yield('content')
			</div>
		</div>
	</body>
@stop

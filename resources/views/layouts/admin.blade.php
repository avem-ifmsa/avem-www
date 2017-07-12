@extends('layouts.app')

@section('body')
	<body class="admin">
		<div id="app">
			<div class="section-header w-100">
				<a class="header-icon" href="{{ route('admin.index') }}">
					{!! file_get_contents('img/avem-logo.svg') !!}
				</a>
				<h1 class="header-title">Panel de administración</h1>
			</div>
			
			<div class="container">
				@yield('content')
			</div>
		</div>
	</body>
@stop

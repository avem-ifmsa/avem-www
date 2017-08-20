@extends('layouts.app')

@push('scripts')
	<script>
		function toggleHeaderMenu() {
			$(document.body).toggleClass('is-menu-active');
		}
	</script>
@endpush

@section('body')
	<body class="main">
		<div id="app" class="page-root">
			<div class="page-header">
				<a class="header-icon" href="{{ route('welcome') }}">
					{!! file_get_contents('img/avem-logo.svg') !!}
				</a>

				<button type="button" class="header-menu-toggle" onclick="toggleHeaderMenu()">
					<i class="fa fa-bars"></i>
				</button>

				<nav class="header-menu">
					<ul class="header-menu-items">
						<li class="header-menu-item">
							<a class="header-menu-link" href="{{ route('welcome') }}">Inicio</a>
						</li>

						<li class="header-menu-item">
							<a class="header-menu-link" href="{{ route('activities') }}">Actividades</a>
						</li>

						<li class="header-menu-item">
							<a class="header-menu-link" href="{{ route('exchanges') }}">Intercambios</a>
						</li>

						<li class="header-menu-item">
							<a class="header-menu-link" href="https://blog.avem.es">Blog</a>
						</li>

						<li class="header-menu-item">
							<a class="header-menu-link" href="{{ route('about') }}">Quiénes somos</a>
						</li>
					</ul>
				</div>
			</nav>

			<div class="container">
				@yield('content')
			</div>
		</div>
	</body>
@stop

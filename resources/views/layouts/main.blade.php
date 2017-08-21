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

				<div class="l-user-menu">
					@if (Auth::guest())
						<div class="user-menu user-menu--guest">
							<a class="help-btn" role="button" href="http://help.avem.es">
								<i class="fa fa-lg fa-question-circle"></i>
							</a>

							<a class="login-btn" role="button" href="{{ route('login') }}">
								Inicia sesión
							</a>
						</div>
					@else
						<?php $user = Auth::user() ?>
						<div class="user-menu">
							<button type="button" role="button" class="menu-toggle"
							        data-toggle="collapse" data-target="#user-menu">
								Hola, {{ $user->name }}
								<i class="ml-1 fa fa-caret-down"></i>
							</button>

							<div id="user-menu" class="collapse l-menu-content menu-content">
								<img class="user-image" src="{{ $user->profileImageUrl }}">

								<div class="user-info">
									<span class="user-name">{{ $user->fullName }}</span>
									<span class="user-email">{{ $user->email }}</span>
								</div>

								@unless ($user->isActive)
									<div class="user-status">
										<span class="badge badge-warning">
											No activo
										</span>
									</div>
								@endif

								<form action="{{ route('logout') }}" method="post">
									{{ csrf_field() }}
									<button type="submit" class="logout-btn" role="button">
										Cerrar sesión
									</button>
								</form>
							</div>
						</div>
					@endif
				</div>

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
				</nav>
			</div>

			<div class="container">
				@yield('content')
			</div>
		</div>
	</body>
@stop

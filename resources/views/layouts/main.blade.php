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

				<!--
				<button type="button" class="header-menu-toggle" onclick="toggleHeaderMenu()">
					<i class="fa fa-bars"></i>
				</button>
				-->

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

								<a class="user-button" role="button" href="{{ route('home') }}">
									Entorno de usuario
								</a>

								<form action="{{ route('logout') }}" method="post">
									{{ csrf_field() }}
									<button type="submit" class="user-button" role="button">
										Cerrar sesión
									</button>
								</form>
							</div>
						</div>
					@endif
				</div>

				<!--
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
			-->
			</div>

			<div class="container">
				@yield('content')
			</div>

			<footer class="l-footer footer">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-3 footer-section footer-section--about">
							<div class="section-logo">
								{!! file_get_contents('img/avem-icon.svg') !!}
							</div>

							<h4 class="section-title">
								Associació Valenciana d'Estudiants de Medicina
							</h4>

							<p class="section-content">
								La <abbr title="Asociación Valenciana de Estudiantes de Medicina">AVEM</abbr>
								es un Comité Local de IFMSA-Spain que ofrece un programa de intercambios y actividades.
							</p>
						</div>

						<div class="col-md-3 footer-section">
							<h4 class="section-title">Noticias</h4>
							<ul class="section-content">
								<li><a class="section-link" href="https://blog.avem.es">Blog</a></li>
								<li><a class="section-link" href="https://www.facebook.com/avem.ifmsavalencia">Facebook</a></li>
								<li><a class="section-link" href="https://www.instagram.com/avem_ifmsa/">Instagram</a></li>
							</ul>
						</div>

						<div class="col-md-3 footer-section">
							<h4 class="section-title">Sobre nosotros</h4>
							<ul class="section-content">
								<li><a class="section-link" href="http://help.avem.es/avem-e-ifmsa/quien-manda-en-avem.html">Junta directiva</a></li>
								<li><a class="section-link" href="http://help.avem.es/avem-e-ifmsa/cualquier-persona-puede-ser-miembro-de-la-junta-directiva.html">Participa en la junta directiva</a></li>
								<li><a class="section-link" href="https://medium.com/@AVEM/t%C3%A9rminos-y-condiciones-da509034f946">Términos y condiciones</a></li>
							</ul>
						</div>

						<div class="col-md-3 footer-section">
							<h4 class="section-title">Ayuda</h4>
							<ul class="section-content">
								<li><a class="section-link" href="http://help.avem.es">Centro de ayuda</a></li>
								<li><a class="section-link" href="#">Normativa de la asociación</a></li>
								<li><a class="section-link" href="#">Código de conducta</a></li>
								<li><a class="section-link" href="mailto:reportar@avem.es">Reportar un incidente</a></li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</body>
@stop

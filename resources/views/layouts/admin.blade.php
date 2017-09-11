@extends('layouts.app')

@section('body')
	<body class="admin">
		<div id="app">
			<div class="page-header w-100">
				<a class="header-icon" href="{{ route('admin.index') }}">
					{!! file_get_contents('img/avem-logo.svg') !!}
				</a>

				<h1 class="header-title">Panel de administración</h1>

				<div class="l-user-menu">
					<?php $user = Auth::user() ?>
					<div class="user-menu user-menu--admin">
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

							@if ($user->hasActiveCharge)
								<div class="user-status">
									<span class="badge badge-info">
										{{ $user->currentCharge->name }}
									</span>
								</div>
							@endif

							<form action="{{ route('logout') }}" method="post">
								{{ csrf_field() }}
								<button type="submit" class="user-button" role="button">
									Cerrar sesión
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="container">
				<div class="my-4">
					@yield('content')
				</div>
			</div>
		</div>
	</body>
@stop

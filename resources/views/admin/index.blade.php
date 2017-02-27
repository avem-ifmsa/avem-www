@extends('layouts.admin')

@section('content')
	<header class="mb-4 text-center">
		<h1>Panel de administración</h1>
	</header>

	<nav class="mb-5 dashboard dashboard--admin">
		<a class="dashboard-item" href="{{ route('admin.activities.index') }}">
			<div class="item-icon">
				{!! file_get_contents(public_path('img/admin-activities.svg')) !!}
			</div>
			<span class="item-text">Gestión de actividades</span>
		</a>

		<a class="dashboard-item" href="{{ route('admin.exchanges.index') }}">
			<div class="item-icon">
				{!! file_get_contents(public_path('img/admin-exchanges.svg')) !!}
			</div>
			<span class="item-text">Gestión de intercambios</span>
		</a>

		<a class="dashboard-item" href="{{ route('admin.notifications.index') }}">
			<div class="item-icon">
				{!! file_get_contents(public_path('img/admin-notifications.svg')) !!}
			</div>
			<span class="item-text">Gestión de notificaciones</span>
		</a>

		<a class="dashboard-item" href="{{ route('admin.users.index') }}">
			<div class="item-icon">
				{!! file_get_contents(public_path('img/admin-users.svg')) !!}
			</div>
			<span class="item-text">Gestión de usuarios</span>
		</a>

		<a class="dashboard-item" href="{{ route('admin.board') }}">
			<div class="item-icon">
				{!! file_get_contents(public_path('img/admin-board.svg')) !!}
			</div>
			<span class="item-text">Gestión de junta directiva</span>
		</a>

		<a class="dashboard-item" href="{{ route('admin.analytics') }}">
			<div class="item-icon">
				{!! file_get_contents(public_path('img/admin-analytics.svg')) !!}
			</div>
			<span class="item-text">Analíticas</span>
		</a>
	</nav>
@stop

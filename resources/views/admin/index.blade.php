@extends('layouts.admin')

@section('content')
	<h1 class="mt-3 text-center">Panel de administración</h1>

	<nav class="my-4 dashboard dashboard--admin">
		<a class="dashboard-item" href="{{ route('admin.activities.index') }}">
			<img class="item-icon" src="{{ asset('img/admin-activities.svg') }}">
			<span class="item-text">Gestión de actividades</span>
		</a>

		<a class="dashboard-item" href="{{ route('admin.exchanges.index') }}">
			<img class="item-icon" src="{{ asset('img/admin-exchanges.svg') }}">
			<span class="item-text">Gestión de intercambios</span>
		</a>

		<a class="dashboard-item dashboard-item--disabled" href="{{ route('admin.notifications.index') }}">
			<img class="item-icon" src="{{ asset('img/admin-notifications.svg') }}">
			<span class="item-text">Gestión de notificaciones</span>
		</a>

		<a class="dashboard-item" href="{{ route('admin.users.index') }}">
			<img class="item-icon" src="{{ asset('img/admin-users.svg') }}">
			<span class="item-text">Gestión de usuarios</span>
		</a>

		<a class="dashboard-item" href="{{ route('admin.board') }}">
			<img class="item-icon" src="{{ asset('img/admin-board.svg') }}">
			<span class="item-text">Gestión de junta directiva</span>
		</a>

		<a class="dashboard-item dashboard-item--disabled" href="{{ route('admin.analytics') }}">
			<img class="item-icon" src="{{ asset('img/admin-analytics.svg') }}">
			<span class="item-text">Analíticas</span>
		</a>
	</nav>
@stop

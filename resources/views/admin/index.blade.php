@extends('layouts.admin')

@section('content')
	<h1 class="text-center">Panel de administración</h1>

	<nav class="my-5 dashboard dashboard--admin">
		<a class="dashboard-item" href="{{ route('admin.activities.index') }}">
			<div class="item-icon">
				<span class="fa fa-calendar"></span>
			</div>
			<span class="item-text">Actividades</span>
		</a>

		<a class="dashboard-item" href="{{ route('admin.exchanges.index') }}">
			<div class="item-icon">
				<span class="fa fa-globe"></span>
			</div>
			<span class="item-text">Intercambios</span>
		</a>

		<a class="dashboard-item" href="{{ route('admin.users.index') }}">
			<div class="item-icon">
				<span class="fa fa-users"></span>
			</div>
			<span class="item-text">Usuarios</span>
		</a>

		<a class="dashboard-item" href="{{ route('admin.board') }}">
			<div class="item-icon">
				<span class="fa fa-sitemap"></span>
			</div>
			<span class="item-text">Junta directiva</span>
		</a>

		<a class="dashboard-item item--disabled" href="{{ route('admin.analytics') }}">
			<div class="item-icon">
				<span class="fa fa-pie-chart"></span>
			</div>
			<span class="item-text">Analíticas</span>
		</a>

		<a class="dashboard-item item--disabled" href="#">
			<div class="item-icon">
				<span class="fa fa-cogs"></span>
			</div>
			<span class="item-text">Avanzado</span>
		</a>
	</nav>
@stop

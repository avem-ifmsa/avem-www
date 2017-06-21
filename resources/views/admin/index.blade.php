@extends('layouts.admin')

@section('section-title')
	Panel de administración
@stop

@section('content')
	<nav class="dashboard dashboard--admin">
		<ul class="dashboard-items">
			<li class="dashboard-item">
				<a href="{{ route('admin.activities.index') }}">
					<div class="item-icon">
						<span class="fa fa-calendar"></span>
					</div>
					<span class="item-text">Actividades</span>
				</a>
			</li>

			<li class="dashboard-item">
				<a href="{{ route('admin.exchanges.index') }}">
					<div class="item-icon">
						<span class="fa fa-globe"></span>
					</div>
					<span class="item-text">Intercambios</span>
				</a>
			</li>

			<li class="dashboard-item">
				<a href="{{ route('admin.users.index') }}">
					<div class="item-icon">
						<span class="fa fa-users"></span>
					</div>
					<span class="item-text">Usuarios</span>
				</a>
			</li>

			<li class="dashboard-item">
				<a href="{{ route('admin.board') }}">
					<div class="item-icon">
						<span class="fa fa-sitemap"></span>
					</div>
					<span class="item-text">Junta directiva</span>
				</a>
			</li>

			<li class="dashboard-item">
				<a href="https://dashboard.heroku.com/apps/avem-www/" target="_blank">
					<div class="item-icon">
						<span class="fa fa-cogs"></span>
					</div>
					<span class="item-text">Avanzado</span>
				</a>
			</li>

			<li class="dashboard-item item--disabled">
				<a href="{{ route('admin.analytics') }}">
					<div class="item-icon">
						<span class="fa fa-pie-chart"></span>
					</div>
					<span class="item-text">Analíticas</span>
				</a>
			</li>
		</ul>
	</nav>
@stop

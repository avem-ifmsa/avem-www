@extends('layouts.admin')

@section('content')
	<header>
		<h1>Panel de administración</h1>
	</header>

	<nav>
		<ul class="list-unstyled">
			<div class="row">
				<li class="col-md-4">
					<a href="{{ route('admin.activities.index') }}">
						<img class="item-icon" src="/img/admin-activities.png">
						<span class="item-text">Gestión de actividades</span>
					</a>
				</li>

				<li class="col-md-4">
					<a href="{{ route('admin.exchanges.index') }}"
					{{ Gate::denies('view', Avem\Exchange::class)
					   ? 'class=disabled aria-disabled=true' : '' }}>
						<img class="item-icon" src="/img/admin-exchanges.png">
						<span class="item-text">Gestión de intercambios</span>
					</a>
				</li>

				<li class="col-md-4">
					<a href="{{ route('admin.notifications.index') }}"
					{{ Gate::denies('view', Avem\Notification::class)
					   ? 'class=disabled aria-disabled=true' : '' }}>
						<img class="item-icon" src="/img/admin-notifications.png">
						<span class="item-text">Gestión de notificaciones</span>
					</a>
				</li>
			</div>

			<div class="row">
				<li class="col-md-4">
					<a href="{{ route('admin.users.index') }}"
					{{ Gate::denies('view', Avem\User::class)
					   ? 'class=disabled aria-disabled=true' : '' }}>
						<img class="item-icon" src="/img/admin-users.png">
						<span class="item-text">Gestión de usuarios</span>
					</a>
				</li>

				<li class="col-md-4">
					<a href="{{ route('admin.mboard') }}"
					{{ (Gate::denies('view', Avem\Charge::class)   &&
					    Gate::denies('view', Avem\MbMember::class) &&
					    Gate::denies('view', Avem\WorkingGroup::class))
					    ? 'class=disabled aria-disabled=true' : '' }}>
						<img class="item-icon" src="/img/admin-mboard.png">
						<span class="item-text">Gestión de junta directiva</span>
					</a>
				</li>

				<li class="col-md-4">
					<a href="{{ route('admin.analytics') }}">
						<img class="item-icon" src="/img/admin-analytics.png">
						<span class="item-text">Analíticas</span>
					</a>
				</li>
			</div>
		</ul>
	</nav>
@stop

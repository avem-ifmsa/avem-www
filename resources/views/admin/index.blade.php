@extends('layouts.admin')

@section('content')
	<div class="dashboard">
		<ul class="dashboard-items">
			<li class="dashboard-item">
				<a href="{{ route('admin.activities.index') }}">
					<img class="item-icon" src="/img/admin-activities.png">
					<span class="item-text">Gestión de actividades</span>
				</a>
			</li>

			<li class="dashboard-item{{ Gate::denies('view', Avem\Exchange::class)
			                            ? ' dashboard-item--disabled' : '' }}">
				<a href="{{ route('admin.exchanges.index') }}">
					<img class="item-icon" src="/img/admin-exchanges.png">
					<span class="item-text">Gestión de intercambios</span>
				</a>
			</li>

			<li class="dashboard-item{{ Gate::denies('view', Avem\Notification::class)
			                            ? ' dashboard-item--disabled' : '' }}">
				<a href="{{ route('admin.notifications.index') }}">
					<img class="item-icon" src="/img/admin-notifications.png">
					<span class="item-text">Gestión de notificaciones</span>
				</a>
			</li>

			<li class="dashboard-item{{ Gate::denies('view', Avem\User::class)
			                            ? ' dashboard-item--disabled' : '' }}">
				<a href="{{ route('admin.users.index') }}">
					<img class="item-icon" src="/img/admin-users.png">
					<span class="item-text">Gestión de usuarios</span>
				</a>
			</li>

			<li class="dashboard-item{{ (Gate::denies('view', Avem\Charge::class)   &&
			                             Gate::denies('view', Avem\MbMember::class) &&
			                             Gate::denies('view', Avem\WorkingGroup::class))
			                             ? ' dashboard-item--disabled' : '' }}">
				<a href="{{ route('admin.mboard') }}">
					<img class="item-icon" src="/img/admin-mboard.png">
					<span class="item-text">Gestión de junta directiva</span>
				</a>
			</li>

			<li class="dashboard-item{{ Gate::denies('view-analytics')
			                            ? ' dashboard-item--disabled' : '' }}">
				<a href="{{ route('admin.analytics') }}">
					<img class="item-icon" src="/img/admin-analytics.png">
					<span class="item-text">Analíticas</span>
				</a>
			</li>
		</ul>
	</div>
@stop

@extends('app')

@section('content')
	<div class="dashboard">
		<div class="dashboard-entry{{ Gate::denies('view', Avem\Activity::class)
		                              ? ' dashboard-entry--disabled' : '' }}">
			<a href="{{ route('admin.activities.index') }}">
				<img class="entry-icon" src="/img/admin-activities.png">
				<span class="entry-text">Gestión de actividades</span>
			</a>
		</div>

		<div class="dashboard-entry{{ Gate::denies('view', Avem\Exchange::class)
		                              ? ' dashboard-entry--disabled' : '' }}">
			<a href="{{ route('admin.exchanges.index') }}">
				<img class="entry-icon" src="/img/admin-exchanges.png">
				<span class="entry-text">Gestión de intercambios</span>
			</a>
		</div>

		<div class="dashboard-entry{{ Gate::denies('view', Avem\Notification::class)
		                              ? ' dashboard-entry--disabled' : '' }}">
			<a href="{{ route('admin.notifications.index') }}">
				<img class="entry-icon" src="/img/admin-notifications.png">
				<span class="entry-text">Gestión de notificaciones</span>
			</a>
		</div>

		<div class="dashboard-entry{{ Gate::denies('view', Avem\User::class)
		                              ? ' dashboard-entry--disabled' : '' }}">
			<a href="{{ route('admin.users.index') }}">
				<img class="entry-icon" src="/img/admin-users.png">
				<span class="entry-text">Gestión de usuarios</span>
			</a>
		</div>

		<div class="dashboard-entry{{ (Gate::denies('view', Avem\Charge::class)   &&
		                               Gate::denies('view', Avem\MbMember::class) &&
		                               Gate::denies('view', Avem\WorkingGroup::class))
		                               ? ' dashboard-entry--disabled' : '' }}">
			<a href="{{ route('admin.mboard') }}">
				<img class="entry-icon" src="/img/admin-mboard.png">
				<span class="entry-text">Gestión de junta directiva</span>
			</a>
		</div>

		<div class="dashboard-entry{{ Gate::denies('view-analytics')
		                              ? ' dashboard-entry--disabled' : '' }}">
			<a href="{{ route('admin.analytics') }}">
				<img class="entry-icon" src="/img/admin-analytics.png">
				<span class="entry-text">Analíticas</span>
			</a>
		</div>
	</div>
@stop

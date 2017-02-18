@extends('layouts.admin')

@section('content')
	<h1>Gestión de junta directiva</h1>
	<div class="dashboard">
		<ul class="dashboard-items">
			<li class="dashboard-item{{ Gate::denies('view', Avem\Charge::class)
			                            ? ' dashboard-item--disabled' : '' }}">
				<a href="{{ route('admin.charges.index') }}">
					<img class="item-icon" src="{{ asset('img/admin-charges.png') }}">
					<span class="item-text">Cargos</span>
				</a>
			</li>

			<li class="dashboard-item{{ Gate::denies('view', Avem\WorkingGroup::class)
			                            ? ' dashboard-item--disabled' : '' }}">
				<a href="{{ route('admin.working-groups.index') }}">
					<img class="item-icon" src="{{ asset('img/admin-working_groups.png') }}">
					<span class="item-text">Grupos de trabajo</span>
				</a>
			</li>

			<li class="dashboard-item{{ Gate::denies('view', Avem\MbMember::class)
			                            ? ' dashboard-item--disabled' : '' }}">
				<a href="{{ route('admin.mb-members.index') }}">
					<img class="item-icon" src="{{ asset('img/admin-mb_members.png') }}">
					<span class="item-text">Miembros de junta</span>
				</a>
			</li>
		</ul>
	</div>
@stop

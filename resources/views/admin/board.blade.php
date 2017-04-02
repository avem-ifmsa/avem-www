@extends('layouts.admin')

@section('content')
	<header>
		<h1>Gestión de junta directiva</h1>
	</header>

	<nav>
		<ul class="list-unstyled">
			<li>
				<a href="{{ route('admin.charges.index') }}">
					<img class="item-icon" src="{{ asset('img/admin-charges.png') }}">
					<span class="item-text">Cargos</span>
				</a>
			</li>

			<li>
				<a href="{{ route('admin.workingGroups.index') }}">
					<img class="item-icon" src="{{ asset('img/admin-working_groups.png') }}">
					<span class="item-text">Grupos de trabajo</span>
				</a>
			</li>

			<li>
				<a href="{{ route('admin.mbMembers.index') }}">
					<img class="item-icon" src="{{ asset('img/admin-mb_members.png') }}">
					<span class="item-text">Miembros de junta</span>
				</a>
			</li>
		</ul>
	</nav>
@stop

@extends('layouts.admin')

@section('content')
	<header>
		<h1>Gestión de junta directiva</h1>
	</header>

	<nav>
		<ul>
			<li>
				<a href="{{ route('admin.charges.index') }}"
				{ Gate::denies('view', Avem\Charge::class)
				  ? 'class=disabled aria-disabled=true' : '' }}>
					<img class="item-icon" src="{{ asset('img/admin-charges.png') }}">
					<span class="item-text">Cargos</span>
				</a>
			</li>

			<li>
				<a href="{{ route('admin.working_groups.index') }}"
				{{ Gate::denies('view', Avem\WorkingGroup::class)
				   ? 'class=disabled aria-disabled=true' : '' }}>
					<img class="item-icon" src="{{ asset('img/admin-working_groups.png') }}">
					<span class="item-text">Grupos de trabajo</span>
				</a>
			</li>

			<li>
				<a href="{{ route('admin.mb_members.index') }}"
				{{ Gate::denies('view', Avem\MbMember::class)
				   ? 'class=disabled aria-disabled=true' : '' }}>
					<img class="item-icon" src="{{ asset('img/admin-mb_members.png') }}">
					<span class="item-text">Miembros de junta</span>
				</a>
			</li>
		</ul>
	</nav>
@stop

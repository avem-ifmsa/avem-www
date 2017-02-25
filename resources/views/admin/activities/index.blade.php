@extends('layouts.admin')

@section('content')
	<h1 class="my-4">Gestión de actividades</h1>

	<section>
		<h2 class="mb-3 text-center">Actividades organizadas por tí</h2>

		<div>
			<a class="btn btn-secondary{{ Gate::denies('create', Avem\Activity::class) ? ' disabled' : ''}}"
			{{ Gate::denies('create', Avem\Activity::class) ? 'aria-disabled=true' : '' }}
			   href="{{ route('admin.activities.create') }}">Crear nueva actividad</a>
		</div>

		<ul class="list-unstyled">
			@foreach ($organizedActivities as $activity)
				<li>
					<span>{{ $activity->name }}</span>
					<img src="{{ $activity->image_url }}">
					<form class="btn-group" action="{{ route('admin.activities.destroy', [$activity]) }}" method="post">
						{{ csrf_field() }}
						{{ method_field('delete') }}

						<a class="btn btn-secondary{{ Gate::denies('update', $activity) ? ' disabled' : '' }}"
						{{ Gate::denies('update', $activity) ? 'aria-disabled=true' : '' }}
						   href="{{ route('admin.activities.edit', [$activity]) }}">Editar</a>

						<button {{ Gate::denies('destroy', $activity) ? 'disabled' : '' }}
						           type="submit" class="btn btn-sm btn-danger">Eliminar</button>
					</form>
				</li>
			@endforeach
		</ul>
	</section>

	<section>
		<h2 class="text-center">Resto de actividades</h2>
		<ul class="mb-3 list-unstyled">
			@foreach ($otherActivities as $activity)
				<li>
					<span>{{ $activity->name }}</span>
					<img src="{{ $activity->image_url }}">
					<form class="btn-group" action="{{ route('admin.activities.destroy', [$activity]) }}" method="post">
						{{ csrf_field() }}
						{{ method_field('delete') }}

						<a class="btn btn-secondary{{ Gate::denies('update', $activity) ? ' disabled' : '' }}"
						{{ Gate::denies('update', $activity) ? 'aria-disabled=true' : '' }}
						   href="{{ route('admin.activities.edit', [$activity]) }}">Editar</a>

						<button {{ Gate::denies('destroy', $activity) ? 'disabled' : '' }}
						           type="submit" class="btn btn-sm btn-danger">Eliminar</button>
					</form>
				</li>
			@endforeach
		</ul>
	</section>
@stop

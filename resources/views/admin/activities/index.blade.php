@extends('layouts.admin')

@section('content')
	<h1 class="my-4">Gestión de actividades</h1>

	<form class="my-4 col-lg-8 offset-lg-2">
		<p class="input-group">
			<input name="q" class="form-control" type="search" />
			<button class="btn btn-secondary input-group-addon"
			        type="submit" role="button">Buscar</button>
		</p>
	</form>

	<section>
		<h2 class="mb-3 text-center">Actividades organizadas por tí</h2>
		<table class="table table-hover table-responsive">
			<thead class="thead-inverse">
				<tr>
					<th class="align-middle">Nombre</th>
					<th class="align-middle">Inicio de la actividad</th>
					<th class="align-middle">Fin de la actividad</th>
					<th class="align-middle text-nowrap">
						<a class="btn btn-sm btn-secondary{{ Gate::denies('create', Avem\Activity::class) ? ' disabled' : ''}}"
						{{ Gate::denies('create', Avem\Activity::class) ? 'aria-disabled=true' : '' }} role="button"
						   href="{{ route('admin.activities.create') }}">Crear nueva actividad</a>
					</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($organizedActivities as $activity)
					<td>{{ $activity->name  }}</td>
					<td>{{ $activity->start }}</td>
					<td>{{ $activity->end   }}</td>
					<td>
						<div class="form-inline">
							<a class="mx-1 btn btn-secondary{{ Gate::denies('update', $activity) ? ' disabled' : '' }}"
							{{ Gate::denies('update', $activity) ? 'aria-disabled=true' : '' }} role="button"
							   href="{{ route('admin.activities.edit', [$activity]) }}">Editar</a>

							<form class="mx-1" action="{{ route('admin.activities.destroy', [$activity]) }}" method="post">
								{{ csrf_field() }}
								{{ method_field('delete') }}
								<button {{ Gate::denies('destroy', $activity) ? 'disabled' : '' }} role="button"
								           type="submit" class="btn btn-sm btn-danger">Eliminar</button>
							</form>
						</div>
					</td>
				@endforeach
			</tbody>
		</table>
	</section>

	<section class="mt-5">
		<h2 class="text-center">Resto de actividades</h2>
		<table class="table table-hover table-responsive">
			<thead class="thead-inverse">
				<tr>
					<th class="align-middle">Nombre</th>
					<th class="align-middle">Inicio de la actividad</th>
					<th class="align-middle">Fin de la actividad</th>
					<th class="align-middle text-nowrap"></th>
				</tr>
			</thead>

			<tbody>
				@foreach ($otherActivities as $activity)
					<tr>
						<td>{{ $activity->name  }}</td>
						<td>{{ $activity->start }}</td>
						<td>{{ $activity->end   }}</td>
						<td>
							<div class="form-inline">
								<a class="mx-1 btn btn-secondary{{ Gate::denies('update', $activity) ? ' disabled' : '' }}"
								{{ Gate::denies('update', $activity) ? 'aria-disabled=true' : '' }} role="button"
								   href="{{ route('admin.activities.edit', [$activity]) }}">Editar</a>

								<form class="mx-1" action="{{ route('admin.activities.destroy', [$activity]) }}" method="post">
									{{ csrf_field() }}
									{{ method_field('delete') }}
									<button {{ Gate::denies('destroy', $activity) ? 'disabled' : '' }} role="button"
											   type="submit" class="btn btn-sm btn-danger">Eliminar</button>
								</form>
							</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</section>
@stop
